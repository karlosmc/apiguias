<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Despatch;
use App\Models\Empresa;
use App\Models\EstadoElectronico;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Cliente de la API de facturación (proyecto FacturacionApi) para las guías.
 *
 * La API arma el XML, firma, envía a SUNAT GRE, consulta el ticket y genera el
 * PDF y el QR. Aquí solo se arma el JSON desde las tablas de guiasapi, se llama
 * a la API y se guarda la respuesta en `estado_electronico`.
 *
 * El resultado final de SUNAT llega después por webhook
 * (WebhookFacturacionController) o con consultar(). Los dos caminos terminan
 * en aplicar(), así que no hay dos versiones del estado.
 *
 * Por ahora solo se emite la guía de remitente (09). La conexión (URL, token,
 * secreto del webhook) se lee de la tabla `empresa` y, si está vacía, del .env.
 *
 * Todos los métodos públicos devuelven un arreglo:
 *   exito, http (código sugerido para responder al front), message, errors,
 *   estado (EstadoElectronico actualizado o null).
 */
class FacturacionApiService
{
    /** La API ya tiene la guía y está esperando a SUNAT: no se reenvía, se consulta. */
    public const EN_PROCESO = ['registered', 'sending', 'pendingTicket'];

    /** Aceptada por SUNAT (observed = aceptada con observaciones). */
    public const FINALES = ['accepted', 'observed'];

    /** La guía existe en la API pero no llegó a SUNAT: se reintenta sobre el mismo fe_id. */
    public const REINTENTAR = ['error', 'signed'];

    private const M1L = 'SUNAT_Envio_IndicadorTrasladoVehiculoM1L';

    /** Empresa emisora, leída una sola vez por petición */
    private $empresa = false;

    /**
     * Guarda y envía, o reintenta, según en qué punto esté la guía.
     */
    public function enviar(Despatch $despatch)
    {
        $estado = $despatch->electronico;

        if (! $estado) {
            return $this->fallo(404, 'La guía no tiene estado electrónico.');
        }

        if ($estado->estado === 'B') {
            return $this->fallo(409, 'La guía está dada de baja: no se puede enviar.', $estado);
        }

        if ($estado->estado === 'F' || in_array($estado->fe_estado, self::FINALES, true)) {
            return $this->fallo(409, 'La guía ya fue aceptada por SUNAT.', $estado);
        }

        if ($falta = $this->faltaConfigurar()) {
            return $this->fallo(503, $falta, $estado);
        }

        // Ya está en SUNAT esperando el ticket: reenviarla duplicaría el envío
        if ($estado->fe_id && in_array($estado->fe_estado, self::EN_PROCESO, true)) {
            return $this->consultar($despatch);
        }

        // Quedó en la API sin llegar a SUNAT: se reintenta el mismo documento
        if ($estado->fe_id && in_array($estado->fe_estado, self::REINTENTAR, true)) {
            return $this->llamar('POST', "documents/{$estado->fe_id}/send", null, $estado);
        }

        // Nueva, o rechazada (la API la reemite sobre el mismo fe_id con los datos corregidos)
        try {
            $payload = $this->payload($despatch);
        } catch (\Throwable $e) {
            return $this->fallo(422, 'No se pudo armar la guía para la API: ' . $e->getMessage(), $estado);
        }

        return $this->llamar('POST', "companies/{$this->ruc()}/despatches", $payload, $estado);
    }

    /**
     * Pide a la API el estado actual (y que consulte el ticket si sigue pendiente).
     */
    public function consultar(Despatch $despatch)
    {
        $estado = $despatch->electronico;

        if (! $estado || ! $estado->fe_id) {
            return $this->fallo(409, 'La guía no se ha enviado por la API: no hay nada que consultar.', $estado);
        }

        if ($falta = $this->faltaConfigurar()) {
            return $this->fallo(503, $falta, $estado);
        }

        return $estado->fe_estado === 'pendingTicket'
            ? $this->llamar('POST', "documents/{$estado->fe_id}/ticket", null, $estado)
            : $this->llamar('GET', "documents/{$estado->fe_id}", null, $estado);
    }

    /**
     * Descarga un archivo de la guía desde la API.
     *
     * @param  string  $tipo     pdf | xml | cdr
     * @param  string  $formato  solo pdf: a4 | sunat
     */
    public function archivo(EstadoElectronico $estado, $tipo = 'pdf', $formato = 'a4')
    {
        $ruta = "documents/{$estado->fe_id}/{$tipo}";
        $query = $tipo === 'pdf' ? ['formato' => $formato] : [];

        return $this->cliente()->get($this->url($ruta), $query);
    }

    /**
     * PDF de SUNAT bajado directo del enlace del QR guardado en la guía
     * (`fe_qr_url` o `hashQr`). Es el respaldo de archivo(..., 'sunat') cuando
     * la API no lo tiene: en beta su enlace no es de SUNAT y la API no lo
     * descarga. Solo enlaces https de sunat.gob.pe, para no hacer peticiones a
     * cualquier dirección guardada. Devuelve el PDF o null.
     */
    public function pdfSunatDirecto(EstadoElectronico $estado)
    {
        $urls = array_unique(array_filter([$estado->fe_qr_url, $estado->hashQr]));

        foreach ($urls as $url) {
            $url = trim((string) $url);
            $host = strtolower((string) parse_url($url, PHP_URL_HOST));

            if (! str_starts_with($url, 'https://') || ! ($host === 'sunat.gob.pe' || str_ends_with($host, '.sunat.gob.pe'))) {
                continue;
            }

            try {
                // Sin "Accept: application/pdf": SUNAT responde 406 con ese encabezado
                $respuesta = Http::connectTimeout(5)->timeout(15)->get($url);
            } catch (ConnectionException $e) {
                Log::warning('No se pudo descargar el PDF de SUNAT.', ['estado' => $estado->id, 'error' => $e->getMessage()]);

                continue;
            }

            if ($respuesta->successful() && str_starts_with($respuesta->body(), '%PDF')) {
                return $respuesta->body();
            }

            Log::info('SUNAT no devolvió un PDF para el QR.', ['estado' => $estado->id, 'http' => $respuesta->status()]);
        }

        return null;
    }

    /**
     * Guarda en `estado_electronico` lo que dice la API (respuesta o webhook).
     *
     * El cuerpo es dato, no instrucción: el estado pasa por un match y lo que
     * no se reconozca queda como pendiente.
     */
    public function aplicar(EstadoElectronico $estado, array $data)
    {
        $feEstado = (string) ($data['estado'] ?? '');
        $sunat = is_array($data['sunat'] ?? null) ? $data['sunat'] : [];

        // El webhook de "aceptada" puede llegar antes que la respuesta del POST
        // (que todavía dice pendingTicket): nunca se retrocede desde un final.
        $yaFinal = in_array($estado->fe_estado, self::FINALES, true);
        if ($yaFinal && ! in_array($feEstado, self::FINALES, true) && $feEstado !== 'voided') {
            $this->aplicarArchivos($estado, $data, $sunat);
            $estado->save();

            return $estado;
        }

        if (! empty($data['id'])) {
            $estado->fe_id = (string) $data['id'];
        }

        $estado->fe_estado = $feEstado ?: null;
        $estado->estadoSunat = $this->etiqueta($feEstado);
        $estado->codigoSunat = (string) ($sunat['codigo'] ?? '');
        $estado->descripcion = $this->descripcion($feEstado, $sunat);
        $estado->ticket = (string) ($data['ticket'] ?? $estado->ticket ?? '');
        $estado->hash = (string) ($data['hash'] ?? $estado->hash ?? '');
        $estado->fe_intentos = (int) ($data['intentos'] ?? $estado->fe_intentos);

        if (! empty($data['enviadoEn'])) {
            $estado->fe_enviado_en = Carbon::parse($data['enviadoEn']);
        }

        $this->aplicarArchivos($estado, $data, $sunat);

        // Estado local: F = final (ya no se edita), B = baja, P = todo lo demás.
        // Una baja local no se deshace por un aviso de la API.
        if ($estado->estado !== 'B') {
            $estado->estado = match (true) {
                in_array($feEstado, self::FINALES, true) => 'F',
                $feEstado === 'voided' => 'B',
                default => 'P',
            };
        }

        $estado->save();

        return $estado;
    }

    /**
     * JSON de POST /companies/{ruc}/despatches (ver docs/INTEGRACION-ERP.md, sección 6).
     */
    public function payload(Despatch $despatch)
    {
        $despatch->loadMissing([
            'clientes.tipoDocumentos', 'terceros.tipoDocumentos', 'compradores.tipoDocumentos',
            'details', 'docsadicionales',
            'envio.motivoTraslado', 'envio.modalidadTraslado', 'envio.transportista',
            'envio.vehiculos', 'envio.conductores.tipoDocumentos', 'envio.ubicaciones',
            'envio.indicadores', 'envio.puerto', 'envio.aeropuerto',
        ]);

        $envio = $despatch->envio;

        if (! $envio) {
            throw new \RuntimeException('la guía no tiene datos de traslado');
        }

        if (! $despatch->clientes) {
            throw new \RuntimeException('la guía no tiene destinatario');
        }

        // Por ahora guiasapi solo emite la guía de remitente
        $tipoDocumento = '09';
        $motivo = $this->codigo(optional($envio->motivoTraslado)->codTraslado);
        $modalidad = $this->codigo(optional($envio->modalidadTraslado)->modTraslado);
        $publico = $modalidad === '01';
        $fecha = Carbon::parse($despatch->fechaEmision);
        $indicadores = $envio->indicadores->pluck('indicador')->filter()->values()->all();

        $payload = [
            'tipoDocumento' => $tipoDocumento,
            'serie' => strtoupper(trim($despatch->serie)),
            'correlativo' => (int) $despatch->correlativo,
            'fechaEmision' => $fecha->toDateString(),
            'horaEmision' => $fecha->format('H:i:s') !== '00:00:00' ? $fecha->format('H:i:s') : null,
            'observacion' => $this->texto($despatch->observacion, 250),
            'destinatario' => $this->parte($despatch->clientes),
            'comprador' => $this->parte($despatch->compradores),
            'documentosRelacionados' => $despatch->docsadicionales->map(fn ($doc) => [
                'tipoDocumento' => $this->codigo($doc->tipo),
                'numeroDocumento' => $this->texto($doc->nro, 30),
                'rucEmisor' => preg_match('/^\d{11}$/', (string) $doc->emisor) ? $doc->emisor : null,
            ])->values()->all(),
            'envio' => [
                'motivoTraslado' => $motivo,
                'descripcionMotivo' => $this->texto(optional($envio->motivoTraslado)->desTraslado, 100),
                'modalidad' => $modalidad,
                'indicadorTransbordo' => (bool) $envio->indTransbordo,
                'vehiculoMenor' => in_array(self::M1L, $indicadores, true),
                'indicadores' => $indicadores,
                'sustentoPeso' => $this->texto($envio->sustentoPeso, 250),
                'pesoTotal' => (float) $envio->pesoTotal,
                'unidadPeso' => $envio->undPesoTotal ?: 'KGM',
                'numeroBultos' => (int) $envio->numBultos >= 1 ? (int) $envio->numBultos : null,
                'fechaTraslado' => $envio->fecTraslado ? Carbon::parse($envio->fecTraslado)->toDateString() : null,
                'fechaEntregaTransportista' => $publico && $envio->fecInicioTrasladoBienes
                    ? Carbon::parse($envio->fecInicioTrasladoBienes)->toDateString()
                    : null,
                'partida' => $this->punto($envio->ubicaciones->firstWhere('tipo', 'P'), $motivo),
                'llegada' => $this->punto($envio->ubicaciones->firstWhere('tipo', 'L'), $motivo),
                'transportista' => $publico && $envio->transportista ? [
                    'numeroDocumento' => trim($envio->transportista->numDoc),
                    'razonSocial' => $this->texto($envio->transportista->rznSocial, 250),
                    'registroMtc' => $this->texto($envio->transportista->nroMtc, 20),
                ] : null,
                'vehiculos' => $envio->vehiculos
                    ->sortBy(fn ($v) => $v->pivot->tipo === 'P' ? 0 : 1)
                    ->map(fn ($v) => $this->vehiculo($v, $publico))
                    // La misma placa como principal y secundaria: va una sola vez
                    ->unique('placa')
                    ->values()->all(),
                'conductores' => $envio->conductores
                    ->sortBy(fn ($c) => $c->pivot->tipo === 'P' ? 0 : 1)
                    ->map(fn ($c) => [
                        'tipoDocumento' => (string) optional($c->tipoDocumentos)->tipoDoc,
                        'numeroDocumento' => trim($c->nroDoc),
                        'nombres' => trim($c->nombres),
                        'apellidos' => trim($c->apellidos),
                        'licencia' => strtoupper(trim($c->licencia)),
                    ])
                    ->values()->all(),
                'puerto' => $envio->puerto ? ['codigo' => $envio->puerto->codigo, 'nombre' => $this->texto($envio->puerto->nombre, 100)] : null,
                'aeropuerto' => $envio->aeropuerto ? ['codigo' => $envio->aeropuerto->codigo, 'nombre' => $this->texto($envio->aeropuerto->nombre, 100)] : null,
            ],
            'items' => $despatch->details->map(fn ($item) => [
                'descripcion' => $this->texto($item->descripcion, 500),
                'cantidad' => (float) $item->cantidad,
                'unidadMedida' => $this->texto($item->unidad, 3),
                'codigo' => $this->texto($item->codigo, 30),
                'codigoSunat' => $this->texto($item->codProdSunat, 8),
            ])->values()->all(),
        ];

        // El "tercero" de la guía de remitente es el proveedor (SellerSupplierParty)
        $tercero = $this->parte($despatch->terceros);
        if ($tercero) {
            $payload['proveedor'] = $tercero;
        }

        return $this->limpiar($payload);
    }

    /**
     * Mensaje si falta configuración, o null si está todo.
     */
    public function faltaConfigurar()
    {
        if (! $this->apiUrl()) {
            return 'Falta la URL de la API de facturación (PUT /api/empresa/facturacion o FE_API_URL), con /api/v1.';
        }

        if (! $this->token()) {
            return 'Falta el token de la API de facturación (PUT /api/empresa/facturacion o FE_API_TOKEN). '
                . 'Se genera en la API con `php artisan fe:client:create`.';
        }

        if (! $this->ruc()) {
            return 'No hay RUC emisor: registre la empresa o configure FE_RUC.';
        }

        return null;
    }

    public function ruc()
    {
        return config('services.facturacion.ruc') ?: optional($this->empresa())->ruc;
    }

    public function apiUrl()
    {
        return optional($this->empresa())->fe_api_url ?: config('services.facturacion.url');
    }

    public function webhookSecret()
    {
        return $this->valorCifrado('fe_webhook_secret') ?: config('services.facturacion.webhook_secret');
    }

    /**
     * Prueba la conexión: pide a la API los datos de la empresa.
     * Dice si el token sirve y si la empresa está lista para emitir guías.
     */
    public function probar()
    {
        if ($falta = $this->faltaConfigurar()) {
            return ['exito' => false, 'http' => 503, 'message' => $falta];
        }

        try {
            $respuesta = $this->cliente()->get($this->url("companies/{$this->ruc()}"));
        } catch (ConnectionException $e) {
            return ['exito' => false, 'http' => 502, 'message' => "No se pudo contactar a la API en {$this->apiUrl()}: " . $e->getMessage()];
        }

        $empresa = $respuesta->json('data') ?? $respuesta->json() ?? [];

        if (! $respuesta->successful()) {
            $motivo = match ($respuesta->status()) {
                401 => 'el token no es válido',
                403 => "el token no tiene acceso al RUC {$this->ruc()}",
                404 => "el RUC {$this->ruc()} no está inscrito en la API",
                default => "la API respondió {$respuesta->status()}",
            };

            return ['exito' => false, 'http' => 502, 'message' => "Conexión con problemas: $motivo."];
        }

        $faltan = [];
        if (empty($empresa['tieneCredencialesGre'])) {
            $faltan[] = 'credenciales GRE (greClientId / greClientSecret)';
        }
        if (array_key_exists('tieneCertificado', $empresa) && ! $empresa['tieneCertificado']) {
            $faltan[] = 'certificado digital';
        }
        if (empty($empresa['webhookUrl'])) {
            $faltan[] = 'webhookUrl (sin él hay que consultar el estado a mano)';
        }
        if (! $this->webhookSecret()) {
            $faltan[] = 'el secreto del webhook en guiasapi';
        }

        return [
            'exito' => $faltan === [],
            'http' => 200,
            'message' => $faltan === []
                ? 'Conexión correcta: la empresa está lista para emitir guías.'
                : 'Conexión correcta, pero falta: ' . implode('; ', $faltan) . '.',
            'empresa' => $empresa,
        ];
    }

    private function token()
    {
        return $this->valorCifrado('fe_api_token') ?: config('services.facturacion.token');
    }

    private function empresa()
    {
        if ($this->empresa === false) {
            $this->empresa = Empresa::first();
        }

        return $this->empresa;
    }

    /**
     * Si el APP_KEY cambió, el valor guardado ya no se puede descifrar: se
     * registra y se cae al .env en vez de romper la emisión con un 500.
     */
    private function valorCifrado($columna)
    {
        try {
            return optional($this->empresa())->{$columna};
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error("No se pudo descifrar empresa.$columna: ¿cambió el APP_KEY? Vuelva a cargarlo.");

            return null;
        }
    }

    private function llamar($metodo, $ruta, ?array $payload, EstadoElectronico $estado)
    {
        $url = $this->url($ruta);
        $inicio = microtime(true);

        try {
            $respuesta = $metodo === 'GET'
                ? $this->cliente()->get($url)
                : $this->cliente()->send($metodo, $url, $payload === null ? [] : ['json' => $payload]);
        } catch (ConnectionException $e) {
            Log::warning('API de facturación sin respuesta', ['url' => $url, 'error' => $e->getMessage()]);

            return $this->fallo(502, 'No se pudo contactar a la API de facturación. La guía quedó guardada; intente enviarla de nuevo.', $estado);
        }

        Log::info('API de facturación', [
            'metodo' => $metodo,
            'ruta' => $ruta,
            'http' => $respuesta->status(),
            'segundos' => round(microtime(true) - $inicio, 2),
        ]);

        return $this->interpretar($respuesta, $estado);
    }

    private function interpretar(Response $respuesta, EstadoElectronico $estado)
    {
        $http = $respuesta->status();
        $cuerpo = $respuesta->json() ?? [];

        if ($http === 401) {
            return $this->fallo(502, 'El token de la API de facturación no es válido (FE_API_TOKEN).', $estado);
        }

        if ($http === 403) {
            return $this->fallo(502, "El token de la API no tiene acceso al RUC {$this->ruc()}.", $estado);
        }

        if ($http === 422) {
            return $this->fallo(422, 'La API rechazó los datos de la guía: ' . ($cuerpo['message'] ?? 'validación fallida')
                . '. No se envió nada a SUNAT; corrija y vuelva a enviar con el mismo número.', $estado, $cuerpo['errors'] ?? []);
        }

        $data = $cuerpo['data'] ?? null;

        // 2xx, o 409 (ya existía en la API: se toma el existente como éxito)
        if (is_array($data) && ($respuesta->successful() || $http === 409)) {
            $this->aplicar($estado, $data);

            return [
                'exito' => ! in_array($estado->fe_estado, ['rejected', 'error'], true),
                'http' => 200,
                'message' => $estado->descripcion,
                'errors' => [],
                'estado' => $estado,
            ];
        }

        return $this->fallo(502, "La API de facturación respondió {$http}: " . ($cuerpo['message'] ?? $cuerpo['error'] ?? 'respuesta no reconocida'), $estado);
    }

    private function aplicarArchivos(EstadoElectronico $estado, array $data, array $sunat)
    {
        if (! empty($sunat['urlQr'])) {
            $estado->fe_qr_url = $sunat['urlQr'];
            $estado->hashQr = $sunat['urlQr'];
        }

        if (array_key_exists('pdfSunatDescargado', $sunat)) {
            $estado->fe_pdf_sunat = (bool) $sunat['pdfSunatDescargado'];
        }
    }

    /** estado_electronico.estadoSunat es varchar(10) */
    private function etiqueta($feEstado)
    {
        return match ($feEstado) {
            'accepted' => 'ACEPTADO',
            'observed' => 'OBSERVADO',
            'rejected' => 'RECHAZADO',
            'error' => 'ERROR',
            'voided' => 'ANULADO',
            'signed' => 'FIRMADO',
            default => 'PENDIENTE',
        };
    }

    private function descripcion($feEstado, array $sunat)
    {
        $mensaje = trim((string) ($sunat['descripcion'] ?? ''));
        $notas = collect($sunat['notas'] ?? [])->map(fn ($n) => is_array($n) ? implode(' ', $n) : (string) $n)->implode(' | ');

        return match ($feEstado) {
            'accepted' => $mensaje ?: 'ACEPTADA POR SUNAT',
            'observed' => trim(($mensaje ?: 'ACEPTADA CON OBSERVACIONES') . ($notas ? " ($notas)" : '')),
            'rejected' => 'RECHAZADA POR SUNAT' . ($mensaje ? ": $mensaje" : '') . '. Corrija y vuelva a enviar con el mismo número.',
            'error' => 'ERROR AL ENVIAR A SUNAT' . ($mensaje ? ": $mensaje" : '') . '. Vuelva a enviar.',
            'pendingTicket', 'sending', 'registered' => 'ENVIADA A SUNAT, ESPERANDO RESPUESTA',
            'voided' => 'ANULADA',
            default => $mensaje ?: 'PENDIENTE DE ENVIO',
        };
    }

    private function fallo($http, $message, ?EstadoElectronico $estado = null, array $errors = [])
    {
        return [
            'exito' => false,
            'http' => $http,
            'message' => $message,
            'errors' => $errors,
            'estado' => $estado,
        ];
    }

    private function cliente(): PendingRequest
    {
        return Http::withToken((string) $this->token())
            ->acceptJson()
            ->connectTimeout(10)
            ->timeout((int) config('services.facturacion.timeout', 30));
    }

    private function url($ruta)
    {
        return rtrim((string) $this->apiUrl(), '/') . '/' . ltrim($ruta, '/');
    }

    private function parte(?Cliente $cliente)
    {
        if (! $cliente || trim((string) $cliente->numDoc) === '') {
            return null;
        }

        return [
            'tipoDocumento' => (string) optional($cliente->tipoDocumentos)->tipoDoc,
            'numeroDocumento' => trim($cliente->numDoc),
            'razonSocial' => $this->texto($cliente->rznSocial, 250),
        ];
    }

    private function punto($ubicacion, $motivo)
    {
        if (! $ubicacion) {
            return null;
        }

        $codLocal = trim((string) $ubicacion->codLocal);
        $rucPunto = preg_replace('/\D/', '', (string) $ubicacion->ruc);

        // El código de establecimiento anexo va con el RUC de su DUEÑO
        // (AddressTypeCode listID="ruc"). Se manda siempre explícito: si se
        // omite, la API asume el del emisor en la partida y el del destinatario
        // en la llegada, y eso falla p. ej. en una compra (02), cuya partida es
        // el almacén del proveedor. Punto sin RUC = de la empresa (emisor).
        $rucDueno = $rucPunto === '' ? (string) $this->ruc() : $rucPunto;

        // 0000 (domicilio fiscal) es el valor por defecto de la columna: solo
        // se envía cuando importa, en el traslado entre establecimientos (04).
        // Sin un RUC de 11 dígitos (p. ej. un DNI) no hay dueño que declarar.
        $enviarCodigo = strlen($codLocal) === 4
            && ($codLocal !== '0000' || $motivo === '04')
            && strlen($rucDueno) === 11;

        // La API solo acepta `ruc` junto con codigoEstablecimiento: sin código
        // no se manda ninguno de los dos (limpiar() quita los null).
        return [
            'ubigeo' => trim((string) $ubicacion->ubigeo),
            'direccion' => $this->texto($ubicacion->direccion, 500),
            'codigoEstablecimiento' => $enviarCodigo ? $codLocal : null,
            'ruc' => $enviarCodigo ? $rucDueno : null,
        ];
    }

    /**
     * La autorización especial del vehículo (número + entidad emisora) solo va
     * en transporte público (01). En privado (02) no se envía aunque el
     * vehículo la tenga registrada.
     */
    private function vehiculo($vehiculo, $publico = false)
    {
        $autorizacion = $publico ? $this->texto($vehiculo->nroAutorizacion, 50) : null;
        $entidad = $publico ? $this->texto($vehiculo->codEmisor, 2) : null;

        return [
            'placa' => strtoupper(preg_replace('/\s+/', '', (string) $vehiculo->placa)),
            'numeroCirculacion' => $this->texto($vehiculo->nroCirculacion, 15),
            'numeroAutorizacion' => $autorizacion && $entidad ? $autorizacion : null,
            'entidadAutorizadora' => $autorizacion && $entidad ? $entidad : null,
        ];
    }

    private function codigo($valor)
    {
        $valor = trim((string) $valor);

        return $valor === '' ? null : str_pad($valor, 2, '0', STR_PAD_LEFT);
    }

    private function texto($valor, $max)
    {
        $valor = trim((string) $valor);

        return $valor === '' ? null : mb_substr($valor, 0, $max);
    }

    /**
     * Quita null, '' y arreglos vacíos: la API valida los campos que llegan,
     * así que es mejor no mandarlos que mandarlos vacíos.
     */
    private function limpiar(array $datos)
    {
        // array_is_list() es de PHP 8.1 y el proyecto admite 8.0
        $esLista = $datos === [] || array_keys($datos) === range(0, count($datos) - 1);
        $limpio = [];

        foreach ($datos as $clave => $valor) {
            if (is_array($valor)) {
                $valor = $this->limpiar($valor);

                if ($valor === []) {
                    continue;
                }
            }

            if ($valor === null || $valor === '') {
                continue;
            }

            $limpio[$clave] = $valor;
        }

        return $esLista ? array_values($limpio) : $limpio;
    }
}
