<?php

namespace App\Services;

use App\Exceptions\ScopApiException;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Cliente del API externo de SCOP.
 *
 * El API es un scraper: abre un navegador contra el portal de SCOP en cada
 * consulta y tarda 10-18 s (a veces falla tras ~35 s). Ese tiempo depende de la
 * sucursal y el rango, NO de la placa: el API baja todos los registros y
 * después filtra. Por eso aquí:
 *
 *   - se le pide al API todo (sin placa) y se guarda en caché por sucursal,
 *     rango y tipos;
 *   - la placa se filtra en local, así que otra placa de la misma sucursal y
 *     fechas responde al instante;
 *   - un lock evita que dos usuarios lancen a la vez el mismo scraping.
 */
class ScopApiService
{
    public function consultar(array $filtros, bool $refrescar = false)
    {
        if (! config('services.scop.url') || ! config('services.scop.key')) {
            throw new ScopApiException('Falta configurar API_SCOP y/o API_KEY_SCOP en el .env', 500);
        }

        $placa = $filtros['placa'] ?? null;
        $consulta = Arr::except($filtros, ['placa']);

        [$completo, $desdeCache] = $this->obtenerCompleto($consulta, $refrescar);

        return [
            'data' => $this->filtrarPorPlaca($completo, $placa),
            'desde_cache' => $desdeCache,
        ];
    }

    /**
     * Resultado completo de la sucursal y rango, desde caché o desde el API.
     */
    private function obtenerCompleto(array $consulta, bool $refrescar)
    {
        $clave = 'scop-consulta:' . md5(json_encode($consulta));

        if (! $refrescar && ($guardado = $this->leerCache($clave)) !== null) {
            return [$guardado, true];
        }

        $espera = (int) config('services.scop.timeout') + (int) config('services.scop.connect_timeout') + 5;
        $lock = Cache::lock($clave . ':lock', $espera + 5);

        try {
            // Si otro usuario ya está consultando lo mismo, se espera a que termine
            $lock->block($espera);
        } catch (LockTimeoutException $e) {
            throw new ScopApiException('Hay una consulta igual en curso que no termina. Intenta en unos segundos.', 503, $e);
        }

        try {
            // Mientras se esperaba el lock, quien lo tenía pudo dejar el resultado en caché
            if (! $refrescar && ($guardado = $this->leerCache($clave)) !== null) {
                return [$guardado, true];
            }

            $data = $this->pedirAlApi($consulta);

            if ($this->estaCompleto($data)) {
                Cache::put($clave, ['data' => $data], now()->addMinutes($this->minutosDeCache($consulta['fecha_fin'])));
            }

            return [$data, false];
        } finally {
            $lock->release();
        }
    }

    private function leerCache($clave)
    {
        $guardado = Cache::get($clave);

        // Se guarda envuelto para distinguir "no hay caché" de una respuesta vacía
        return is_array($guardado) && array_key_exists('data', $guardado) ? $guardado['data'] : null;
    }

    private function pedirAlApi(array $consulta)
    {
        $inicio = microtime(true);

        try {
            $response = Http::withHeaders(['x-api-key' => config('services.scop.key')])
                ->acceptJson()
                ->connectTimeout((int) config('services.scop.connect_timeout'))
                ->timeout((int) config('services.scop.timeout'))
                ->post(config('services.scop.url'), $consulta);
        } catch (ConnectionException $e) {
            // Cubre tanto "no conecta" como "se pasó del timeout"
            Log::warning('API SCOP sin respuesta', [
                'segundos' => round(microtime(true) - $inicio, 2),
                'consulta' => $consulta,
                'error' => $e->getMessage(),
            ]);

            throw new ScopApiException('El API de SCOP no respondió a tiempo o no está disponible. Intenta de nuevo.', 504, $e);
        }

        $segundos = round(microtime(true) - $inicio, 2);

        if ($segundos >= (int) config('services.scop.log_lento')) {
            Log::info('API SCOP lento', ['segundos' => $segundos, 'consulta' => $consulta]);
        }

        if ($response->failed()) {
            $this->lanzarError($response, $consulta, $segundos);
        }

        return $response->json();
    }

    /**
     * Deja solo los registros de la placa pedida, con la misma forma que usa el
     * API cuando filtra él: `registros` y `coincidencias` de cada tipo y `placa`
     * arriba. Sin placa devuelve todo, igual que el API.
     *
     * La comparación ignora mayúsculas, guiones y espacios: "beu970" encuentra
     * "BEU-970". Es por placa completa, no parcial.
     */
    private function filtrarPorPlaca($data, $placa)
    {
        if (! is_array($data) || $placa === null || trim((string) $placa) === '') {
            return $data;
        }

        $buscada = $this->normalizarPlaca($placa);

        foreach ($data as $tipo => $bloque) {
            if (! is_array($bloque) || ! isset($bloque['registros']) || ! is_array($bloque['registros'])) {
                continue;
            }

            $registros = array_values(array_filter($bloque['registros'], function ($registro) use ($buscada) {
                return $this->normalizarPlaca($registro['Placa'] ?? '') === $buscada;
            }));

            $data[$tipo]['registros'] = $registros;
            $data[$tipo]['coincidencias'] = count($registros);
        }

        $data['placa'] = $placa;

        return $data;
    }

    private function normalizarPlaca($placa)
    {
        return preg_replace('/[^A-Z0-9]/', '', strtoupper((string) $placa));
    }

    /**
     * Si algún tipo vino con ok=false el resultado es parcial: no se guarda, para
     * no servirlo horas desde caché.
     */
    private function estaCompleto($data)
    {
        if (! is_array($data)) {
            return false;
        }

        foreach ($data as $bloque) {
            if (is_array($bloque) && array_key_exists('ok', $bloque) && $bloque['ok'] !== true) {
                return false;
            }
        }

        return true;
    }

    /**
     * Un rango que ya terminó no va a cambiar: se guarda mucho más tiempo que
     * uno que incluye hoy.
     */
    private function minutosDeCache($fechaFin)
    {
        return Carbon::parse($fechaFin)->endOfDay()->isPast()
            ? (int) config('services.scop.cache_minutos_historico')
            : (int) config('services.scop.cache_minutos');
    }

    private function lanzarError($response, array $consulta, $segundos)
    {
        $status = $response->status();
        $mensaje = (string) ($response->json('error')
            ?? $response->json('message')
            ?? 'Error al obtener los datos');

        Log::warning('API SCOP respondió con error', [
            'status' => $status,
            'segundos' => $segundos,
            'mensaje' => $mensaje,
            'consulta' => $consulta,
        ]);

        // Un 401/403 del API significa que NUESTRA api key falla, no la sesión del
        // usuario. Reenviarlo tal cual haría que el front cierre la sesión.
        if (in_array($status, [401, 403], true)) {
            throw new ScopApiException('El API de SCOP rechazó la API key configurada (API_KEY_SCOP)', 502);
        }

        if ($status >= 500) {
            throw new ScopApiException($this->mensajeParaUsuario($mensaje), 502);
        }

        // 4xx con mensaje útil, p. ej. "No hay credenciales para la sucursal"
        throw new ScopApiException($this->mensajeParaUsuario($mensaje), $status);
    }

    /**
     * El API pega a sus errores el log interno del navegador (Playwright). Al
     * usuario le llega solo algo legible; el mensaje completo queda en el log.
     */
    private function mensajeParaUsuario($mensaje)
    {
        if (stripos($mensaje, 'Timeout') !== false) {
            return 'El portal de SCOP tardó demasiado en responder. Intenta de nuevo en unos segundos.';
        }

        $primeraLinea = trim(strtok($mensaje, "\n"));

        return mb_strimwidth($primeraLinea, 0, 200, '…');
    }
}
