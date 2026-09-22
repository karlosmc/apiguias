<?php

namespace App\Http\Controllers;

use App\Models\AlmacenFafio;
use App\Models\Despatch;
use App\Models\Numeracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MigracionGuiasController extends Controller
{
    private function queryGuiasBase()
    {
        return Despatch::query()
            ->with([
                'clientes',
                'terceros',
                'compradores',
                'envio',
                'details',
                'electronico',
                'envio.ubicaciones',
                'envio.transportista',
                'envio.conductores',
                'envio.vehiculos',
                'docsadicionales',
                'usuario',
                'envio.motivoTraslado',
            ]);
    }

    private function construirCabeceraBase(Despatch $documento, ?AlmacenFafio $almacenInicio, ?AlmacenFafio $almacenFinal): array
    {
        $conductor = $documento->envio?->conductores?->first();
        $vehiculo = $documento->envio?->vehiculos?->first();
        $adicional = $documento->docsadicionales?->first();
        $ubicacionInicio = $documento->envio?->ubicaciones?->firstWhere('tipo', 'P');
        $ubicacionFinal = $documento->envio?->ubicaciones?->firstWhere('tipo', 'L');

        return [
            'IdAlmacen'       => $almacenInicio?->id_almacen_fafio,
            'IdTipoDocumento' => 'GR',
            'Serie'           => $documento->serie,
            'NroDocumento'    => str_pad($documento->correlativo, 7, '0', STR_PAD_LEFT),
            'idCliente'       => $documento->id_cliente,
            'Cliente'         => $documento->clientes?->rznSocial,
            'TipoMovimiento'  => 'S',
            'IdMovimiento'    => str_pad($documento->envio?->id_mottraslado, 2, '0', STR_PAD_LEFT),
            'FechaDocumento'  => $documento->fechaEmision,
            'Situacion'       => $documento->electronico?->estado,
            'IdProveedor'     => null,
            'IdPersonal'      => null,
            'Procedencia'     => null,
            'FechaEnvio'      => $documento->envio?->fecTraslado,
            'Receptor'        => null,
            'Observacion'     => $documento->observacion,
            'IdMoneda'        => null,
            'TipoCambio'      => 0,
            'ValorVenta'      => 0,
            'FechaDocumento2' => null,
            'IdTipoDocRef'    => $adicional?->tipo,
            'NroDocRef'       => $adicional?->nro,
            'EstaConforme'    => 1,
            'UsuarioCrea'     => $documento->id_user,
            'FechaCrea'       => $documento->created_at,
            'UsuarioMod'      => null,
            'FechaMod'        => null,
            'ValorVentaUS'    => $documento->envio?->pesoTotal,
            'situacionguia'   => 'P',
            'DireccionInicio' => $ubicacionInicio?->direccion,
            'DireccionFinal'  => $ubicacionFinal?->direccion,
            'idaralimento'    => null,
            'IdTransportista' => $documento->envio?->transportista?->numDoc,
            'Transportista'   => $documento->envio?->transportista?->rznSocial,
            'IdConductor'     => $conductor?->nombreCortoGlobal(),
            'Conductor'       => $conductor ? trim($conductor->nombres . ' ' . $conductor->apellidos) . ' LIC. ' . $conductor->licencia : null,
            'NroLicencia'     => $conductor?->licencia,
            'IdVehiculo'      => $vehiculo?->id,
            'PlacaVehiculo'   => $vehiculo?->placa,
            'ModeloVehiculo'  => null,
            'Referencial'     => null,
            'formuladiaria'   => null,
            'EsAutomatico'    => null,
            'DeCompra'        => null,
            'CosteoPrueba'    => null,
            'idtipodocRef2'   => 'GR',
            'NroDocRef2'      => $documento->serie . '-' . $documento->correlativo,
            'TdProv'          => null,
            'SerieProv'       => null,
            'NroDocProv'      => null,
            'RucProv'         => null,
            'idalmacen2'      => $almacenFinal?->id_almacen_fafio,
            'Traslado'        => null,
        ];
    }

    private function extraerItemsMigracion(Request $request): array
    {
        $payload = $request->all();

        if (array_is_list($payload)) {
            return $payload;
        }

        $items = $request->input('items');

        if (is_array($items)) {
            return $items;
        }

        $guias = $request->input('guias');
        if (is_array($guias)) {
            return $guias;
        }

        return [];
    }

    private function obtenerValorItem(array $item, array $keys)
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, $item) && $item[$key] !== null && $item[$key] !== '') {
                return $item[$key];
            }
        }

        return null;
    }

    private function resolverAlmacenItem(array $item, array $almacenesPorIdFafio, ?AlmacenFafio $almacenPorDefecto, string $tipo): ?AlmacenFafio
    {
        $valor = $this->obtenerValorItem($item, [
            "almacen_{$tipo}",
            "id_almacen_{$tipo}",
            $tipo,
        ]);

        if ($valor === null) {
            return $almacenPorDefecto;
        }

        return $almacenesPorIdFafio[(string) $valor] ?? $almacenPorDefecto;
    }

    /**
     * Consulta en lote la columna Descripcion2 de la tabla Almacen del sistema externo
     * para obtener la serie asociada a cada IdAlmacen.
     * Retorna ['ALM01' => 'T001', 'ALM02' => 'T002', ...]
     *
     * TODO: cambiar la conexión ('sqlsrv2') cuando se configure la definitiva.
     */
    private function obtenerSeriesDesdeSQL(array $idsAlmacen): array
    {
        $idsAlmacen = array_values(array_unique(array_filter($idsAlmacen, fn($v) => $v !== null && $v !== '')));

        if ($idsAlmacen === []) {
            return [];
        }

        $filas = DB::connection('sqlsrv2')
            ->table('Almacen')
            ->whereIn('IdAlmacen', $idsAlmacen)
            ->select(DB::raw("IdAlmacen, rtrim(isnull(Descripcion2,'')) as serie"))
            ->get();

        $resultado = [];
        foreach ($filas as $fila) {
            $resultado[(string) $fila->IdAlmacen] = $fila->serie !== '' ? $fila->serie : null;
        }

        return $resultado;
    }

    private function inicializarCacheNumeracion(array $series): array
    {
        $series = array_values(array_unique(array_filter($series)));

        if ($series === []) {
            return [];
        }

        return Numeracion::whereIn('serie', $series)
            ->get()
            ->mapWithKeys(function (Numeracion $numeracion) {
                return [
                    $numeracion->serie => [
                        'modelo' => $numeracion,
                        'actual' => (int) $numeracion->numeroActual,
                        'original' => (int) $numeracion->numeroActual,
                    ],
                ];
            })
            ->toArray();
    }

    private function reservarNumeroPorSerie(?string $serie, array &$cache): ?array
    {
        if (!$serie || !isset($cache[$serie])) {
            return null;
        }

        $cache[$serie]['actual']++;
        $correlativo = $cache[$serie]['actual'];

        return [
            'serie' => $serie,
            'correlativo' => $correlativo,
            'documento' => $serie . '-' . str_pad((string) $correlativo, 7, '0', STR_PAD_LEFT),
        ];
    }

    private function persistirNumeracionesReservadas(array $cache): void
    {
        foreach ($cache as $item) {
            if ($item['actual'] === $item['original']) {
                continue;
            }

            $item['modelo']->update([
                'numeroActual' => $item['actual'],
            ]);
        }
    }

    //
    public function obtener()
    {
        $almacen_fafio = DB::connection('sqlsrv')->table('almacen_fafio')->get();
        return response()->json($almacen_fafio);
    }

    public function buscar(Request $request)
    {
        $user = Auth::user();

        $id = $user->id;


        $query = Despatch::query();

        if ($user->perfil !== 'admin') {
            $query->where('id_user', $id);
        }

        if ($request->has('serie')) {

            $query->where('serie', $request->input('serie'));
        }

        if ($request->has('numero')) {

            $query->where('correlativo', $request->input('numero'));
        }

        if ($request->has('fecha')) {

            $query->where(DB::raw('DATE(fechaEmision)'), $request->input('fecha'));
        }

        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $query->whereBetween(DB::raw('DATE(fechaEmision)'), [$request->input('fecha_inicio'), $request->input('fecha_fin')]);
        }
        if ($request->has('estado')) {
            $query->whereHas('electronico', function ($q) use ($request) {
                $q->where('estado', $request->input('estado'));
            });
        }




        $guias = $query->with(['envio.ubicaciones.almacenesFafio', 'electronico', 'envio.motivoTraslado'])
            ->whereHas('electronico')
            ->where('migrado', false)
            ->orderBy('fechaEmision')
            ->orderBy('serie')
            ->orderBy('correlativo')
            ->get();


        $almacenesFafio = AlmacenFafio::all()->keyBy('id_punto_ubicacion');

        $cabeceras = [];


        return response()->json($guias);
    }

    public function buscarAll(Request $request)
    {
        $user = Auth::user();

        $id = $user->id;


        $query = Despatch::query();

        if ($user->perfil !== 'admin') {
            $query->where('id_user', $id);
        }

        if ($request->has('serie')) {

            $query->where('serie', $request->input('serie'));
        }

        if ($request->has('numero')) {

            $query->where('correlativo', $request->input('numero'));
        }

        if ($request->has('fecha')) {

            $query->where(DB::raw('DATE(fechaEmision)'), $request->input('fecha'));
        }

        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $query->whereBetween(DB::raw('DATE(fechaEmision)'), [$request->input('fecha_inicio'), $request->input('fecha_fin')]);
        }
        if ($request->has('estado')) {
            $query->whereHas('electronico', function ($q) use ($request) {
                $q->where('estado', $request->input('estado'));
            });
        }


        $guias = $query->with(['clientes', 'terceros', 'compradores', 'envio', 'details', 'electronico', 'envio.ubicaciones', 'envio.transportista', 'envio.conductores', 'envio.vehiculos', 'docsadicionales', 'usuario', 'envio.motivoTraslado'])
            ->where('migrado', false)
            ->orderBy('fechaEmision')
            ->orderBy('serie')
            ->orderBy('correlativo')
            ->get();

        $almacenesFafio = AlmacenFafio::all()->keyBy('id_punto_ubicacion');

        $cabeceras = [];

        foreach ($guias as $documento) {
            $ubicacionInicio = $documento->envio?->ubicaciones?->firstWhere('tipo', 'P');
            $ubicacionFinal  = $documento->envio?->ubicaciones?->firstWhere('tipo', 'L');

            $almacenInicio = $almacenesFafio->get($ubicacionInicio?->id_puntoubicacion);
            $almacenFinal  = $almacenesFafio->get($ubicacionFinal?->id_puntoubicacion);

            $cabeceras[] = $this->construirCabeceraBase($documento, $almacenInicio, $almacenFinal);
        }

        return response()->json($cabeceras);
    }

    public function almacenes(Request $request)
    {
        $opcion = $request->input('opcion',"1");
        if($opcion==="1"){
            $almacenes = DB::connection('sqlsrv2')->table('Almacen')->get();
            return response()->json($almacenes);
        }else{
            $almacenes = DB::connection('sqlsrv')->table('Almacen')->get();
            return response()->json($almacenes);
        }
    }
    public function migrar(Request $request)
    {
        $items = $this->extraerItemsMigracion($request);

        if ($items === []) {
            return response()->json([
                'message' => 'Debe enviar un arreglo JSON de items de migración.',
                'exito' => false,
            ], 422);
        }

        $idsDespatch = array_values(array_unique(array_filter(array_map(function ($item) {
            return is_array($item) ? ($item['id_despatch'] ?? null) : null;
        }, $items))));

        if ($idsDespatch === []) {
            return response()->json([
                'message' => 'No se recibieron id_despatch válidos.',
                'exito' => false,
            ], 422);
        }

        $documentos = $this->queryGuiasBase()
            ->whereIn('id', $idsDespatch)
            ->where('migrado', false)
            ->get()
            ->keyBy('id');

        $almacenesPorPunto   = AlmacenFafio::all()->keyBy('id_punto_ubicacion');
        $almacenesPorIdFafio = AlmacenFafio::all()->keyBy(fn(AlmacenFafio $a) => (string) $a->id_almacen_fafio);

        // Primera pasada: recolectar todos los IdAlmacen únicos para la consulta batch al SQL externo
        $idsAlmacenParaSQL = [];
        $almacenesResueltos = []; // cache local para no recalcular en la segunda pasada

        foreach ($items as $idx => $item) {
            if (!is_array($item) || !isset($item['id_despatch'])) {
                continue;
            }

            $documento = $documentos->get($item['id_despatch']);
            if (!$documento) {
                continue;
            }

            $ubicacionInicio = $documento->envio?->ubicaciones?->firstWhere('tipo', 'P');
            $ubicacionFinal  = $documento->envio?->ubicaciones?->firstWhere('tipo', 'L');

            $almacenOrigen  = $this->resolverAlmacenItem(
                $item,
                $almacenesPorIdFafio->all(),
                $almacenesPorPunto->get($ubicacionInicio?->id_puntoubicacion),
                'origen'
            );
            $almacenDestino = $this->resolverAlmacenItem(
                $item,
                $almacenesPorIdFafio->all(),
                $almacenesPorPunto->get($ubicacionFinal?->id_puntoubicacion),
                'destino'
            );

            $almacenesResueltos[$idx] = [$almacenOrigen, $almacenDestino];

            if ($almacenOrigen?->id_almacen_fafio) {
                $idsAlmacenParaSQL[] = (string) $almacenOrigen->id_almacen_fafio;
            }
            if ($almacenDestino?->id_almacen_fafio) {
                $idsAlmacenParaSQL[] = (string) $almacenDestino->id_almacen_fafio;
            }
        }

        // Una sola consulta al SQL externo para obtener todas las series
        $seriesExternas = $this->obtenerSeriesDesdeSQL($idsAlmacenParaSQL);

        // Inicializar cache de numeración solo con las series del destino que correspondan
        $seriesNumeracion = [];
        foreach ($almacenesResueltos as [$almacenOrigen, $almacenDestino]) {
            if (!$almacenDestino || !$almacenOrigen) {
                continue;
            }
            if ($almacenDestino->id_almacen_fafio === $almacenOrigen->id_almacen_fafio) {
                continue;
            }
            $serieDestino = $seriesExternas[(string) $almacenDestino->id_almacen_fafio] ?? null;
            if ($serieDestino) {
                $seriesNumeracion[] = $serieDestino;
            }
        }

        $cacheNumeracion = $this->inicializarCacheNumeracion($seriesNumeracion);
        $registros = [];
        $observaciones = [];

        foreach ($items as $idx => $item) {
            if (!is_array($item) || !isset($item['id_despatch'])) {
                $observaciones[] = [
                    'item' => $item,
                    'message' => 'Item omitido por no tener id_despatch.',
                ];
                continue;
            }

            $documento = $documentos->get($item['id_despatch']);
            if (!$documento) {
                $observaciones[] = [
                    'id_despatch' => $item['id_despatch'],
                    'message' => 'La guía no existe o ya fue migrada.',
                ];
                continue;
            }

            // Reusar almacenes ya resueltos en la primera pasada
            [$almacenOrigen, $almacenDestino] = $almacenesResueltos[$idx];

            $serieOrigen = $almacenOrigen
                ? ($seriesExternas[(string) $almacenOrigen->id_almacen_fafio] ?? null)
                : null;

            $registroOrigen = $this->construirCabeceraBase($documento, $almacenOrigen, $almacenDestino);
            $registroOrigen['Serie']          = $serieOrigen ?: $registroOrigen['Serie'];
            $registroOrigen['TipoMovimiento'] = 'S';
            $registroOrigen['idalmacen2']     = $almacenDestino?->id_almacen_fafio;

            $detalleMigracion = [
                'id_despatch' => $documento->id,
                'origen'      => $registroOrigen,
                'destino'     => null,
            ];

            $esTransferencia = $almacenDestino
                && $almacenOrigen
                && $almacenDestino->id_almacen_fafio !== $almacenOrigen->id_almacen_fafio;

            if ($esTransferencia) {
                $serieDestino      = $seriesExternas[(string) $almacenDestino->id_almacen_fafio] ?? null;
                $numeracionDestino = $this->reservarNumeroPorSerie($serieDestino, $cacheNumeracion);

                $registroDestino = $this->construirCabeceraBase($documento, $almacenDestino, $almacenOrigen);
                $registroDestino['IdAlmacen']      = $almacenDestino->id_almacen_fafio;
                $registroDestino['TipoMovimiento'] = 'E';
                $registroDestino['idalmacen2']     = $almacenOrigen?->id_almacen_fafio;
                $registroDestino['Serie']          = $serieDestino ?: $registroDestino['Serie'];

                if ($numeracionDestino) {
                    $registroDestino['Serie']        = $numeracionDestino['serie'];
                    $registroDestino['NroDocumento'] = str_pad((string) $numeracionDestino['correlativo'], 7, '0', STR_PAD_LEFT);
                    $registroDestino['Referencial']  = $registroOrigen['Serie'] . '-' . $registroOrigen['NroDocumento'];
                    $registroOrigen['Referencial']   = $numeracionDestino['documento'];
                } else {
                    $observaciones[] = [
                        'id_despatch'   => $documento->id,
                        'message'       => 'No se encontró numeración para el almacén destino.',
                        'almacen_destino' => $almacenDestino->id_almacen_fafio,
                        'serie_esperada'  => $serieDestino,
                    ];
                }

                $detalleMigracion['origen']  = $registroOrigen;
                $detalleMigracion['destino'] = $registroDestino;
            }

            $registros[] = $detalleMigracion;
        }

        DB::transaction(function () use ($cacheNumeracion) {
            $this->persistirNumeracionesReservadas($cacheNumeracion);
        });

        return response()->json([
            'message' => 'Migración preparada correctamente.',
            'exito' => true,
            'persistio_numeracion' => true,
            'registros' => $registros,
            'numeraciones' => array_values(array_map(function ($serie, $item) {
                return [
                    'serie' => $serie,
                    'numeroActual' => $item['actual'],
                    'numeroInicial' => $item['original'],
                ];
            }, array_keys($cacheNumeracion), $cacheNumeracion)),
            'observaciones' => $observaciones,
        ]);

    }
}
