<?php

namespace App\Http\Controllers;

use App\Http\Requests\DespatchRequest;
use App\Http\Resources\DespatchCollection;
use App\Http\Resources\DespatchResource;
use App\Models\Adicionales;
use App\Models\Despatch;
use App\Models\DespatchProducto;
use App\Models\EstadoElectronico;
use App\Models\Indicadores;
use App\Models\ModalidadTraslado;
use App\Models\MotivoTraslado;
use App\Models\Numeracion;
use App\Models\Scop;
use App\Models\Shipment;
use App\Services\FacturacionApiService;
use App\Models\ShipmentConductor;
use App\Models\ShipmentIndicadores;
use App\Models\ShipmentPuntoubicacion;
use App\Models\ShipmentVehiculo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpParser\Node\Stmt\TryCatch;

class DespatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return new DespatchCollection(Despatch::with('clientes')->with('terceros')->with('compradores')->with('envio')->with('productos')->with('electronico')->get());
    }

    public function buscar(Request $request)
    {

        $user = Auth::user();

        $id = $user->id;


        $query = Despatch::query();

        if ($user->perfil !== 'admin') {
            // id_user es columna de la propia tabla; el whereHas('despatch')
            // anterior apuntaba a una relación que no existe y reventaba.
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
        if($request->has('estado')){
            $query->whereHas('electronico', function($q) use ($request) {
                $q->where('estado', $request->input('estado'));
            });
        }


        $guiasQuery = $query->with(['clientes', 'terceros', 'compradores', 'envio', 'details', 'electronico', 'envio.ubicaciones', 'usuario', 'envio.motivoTraslado'])
            ->orderBy('fechaEmision')
            ->orderBy('serie')
            ->orderBy('correlativo')
            ->get();



        $guias = new DespatchCollection($guiasQuery);



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $encabezados = [
            'ID',
            'Serie',
            'Correlativo',
            'Fecha Emisión',
            'Cliente - Razón Social',
            'Cliente - Número de Documento',
            'Tercero - Razón Social',
            'Tercero - Número de Documento',
            'Observación',
            'Peso Total',
            'Unidad de Peso',
            'Fecha Traslado',
            'Tipo de Traslado',
            'Partida - Dirección',
            'Llegada - Dirección',
            'Producto - Código',
            'Producto - Descripción',
            'Producto - Cantidad',
            'Producto - U. Medida',
            'Usuario',
            'Estado SUNAT',
        ];

        $sheet->fromArray($encabezados, null, 'A1');

        $fila = 2; // Comienza desde la fila 2
        foreach ($guias as $documento) {
            foreach ($documento['details'] as $producto) {
                $sheet->setCellValue("A$fila", $documento['id']);
                $sheet->setCellValue("B$fila", $documento['serie']);
                $sheet->setCellValue("C$fila", $documento['correlativo']);
                $sheet->setCellValue("D$fila", $documento['fechaEmision']);
                $sheet->setCellValue("E$fila", $documento['clientes']['rznSocial'] ?? 'N/A');
                $sheet->setCellValue("F$fila", $documento['clientes']['numDoc'] ?? 'N/A');
                $sheet->setCellValue("G$fila", $documento['terceros']['rznSocial'] ?? 'N/A');
                $sheet->setCellValue("H$fila", $documento['terceros']['numDoc'] ?? 'N/A');
                $sheet->setCellValue("I$fila", $documento['observacion']);
                $sheet->setCellValue("J$fila", $documento['envio']['pesoTotal']);
                $sheet->setCellValue("K$fila", $documento['envio']['undPesoTotal']);
                $sheet->setCellValue("L$fila", $documento['envio']['fecTraslado']);
                $sheet->setCellValue("M$fila", $documento['envio']['motivoTraslado']['desTraslado']);
                $sheet->setCellValue("N$fila", $documento['envio']['ubicaciones'][0]['direccion'] ?? 'N/A');
                $sheet->setCellValue("O$fila", $documento['envio']['ubicaciones'][1]['direccion'] ?? 'N/A');
                $sheet->setCellValue("P$fila", $producto['codigo']);
                $sheet->setCellValue("Q$fila", $producto['descripcion']);
                $sheet->setCellValue("R$fila", $producto['cantidad']);
                $sheet->setCellValue("S$fila", $producto['unidad']);
                $sheet->setCellValue("T$fila", $documento['usuario']['name'] ?? 'N/A');
                $sheet->setCellValue("U$fila", $documento['electronico']['descripcion'] ?? 'N/A');

                $fila++;
            }
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'documentos.xlsx';
        // $filename = 'documentos_prueba.xlsx';
        // $path = storage_path('app/temp/' . $filename);

        // // Asegúrate de que el directorio exista
        // if (!file_exists(storage_path('app/temp'))) {
        //     mkdir(storage_path('app/temp'), 0755, true);
        // }

        // $writer->save($path);

        // return response()->json(['file_path' => $path]);

        $tempFile = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($tempFile);

        return Response::download($tempFile, $filename)->deleteFileAfterSend(true);



        // return new DespatchCollection(Despatch::with(['clientes','terceros','compradores','envio','details','electronico'])->get());

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DespatchRequest $request)
    {
        // Fuera del try para poder consultarlos también desde el catch
        $scops = Scop::normalizar($request->input('scops', $request->input('nroScop')));

        DB::beginTransaction();

        try {
            // La validación de DespatchRequest ocurre antes de la transacción, así
            // que dos peticiones simultáneas (doble clic) la pasan las dos. Este
            // SELECT ... FOR UPDATE serializa la comprobación y evita el duplicado.
            $existente = Despatch::where('serie', $request->serie)
                ->where('correlativo', $request->correlativo)
                ->lockForUpdate()
                ->first();

            if ($existente) {
                DB::rollBack();

                return $this->respuestaDuplicado($request->serie, $request->correlativo, $existente);
            }

            $despatch = new Despatch();
            $despatch->id_user = Auth::user()->id;
            $despatch->version = $request->version;
            $despatch->correlativo = $request->correlativo;
            $despatch->serie = $request->serie;
            $despatch->observacion = $request->observacion ? $request->observacion : '';
            $despatch->fechaEmision = $request->fechaEmision;
            $despatch->id_cliente = ($request->destinatario) ? $request->destinatario['id'] : null;
            $despatch->id_tercero = ($request->tercero) ? $request->tercero['id'] : null;
            $despatch->id_comprador = ($request->comprador) ? $request->comprador['id'] : null;

            $despatch->save();

            $id_despatch = $despatch->id;

            // SCOP: la guía puede traer varios números o ninguno, pero un número
            // no puede estar en dos guías a la vez. El lock serializa la
            // comprobación igual que con serie + correlativo.
            $ocupados = Scop::ocupados($scops, null, true);

            if ($ocupados->isNotEmpty()) {
                DB::rollBack();

                return $this->respuestaScopOcupado($ocupados);
            }

            foreach ($scops as $nroScop) {
                Scop::create([
                    'id_despatch' => $id_despatch,
                    'nroScop' => $nroScop,
                ]);
            }



            // print_r($request->version);q

            foreach ($request->details ?? [] as $detalles) {
                # code...
                DespatchProducto::create([
                    'id_despatch' => $id_despatch,
                    'id_producto' => ($detalles['id'] === 0) ? 1 : $detalles['id'],
                    'codigo' => $detalles['codigo'],
                    'codProdSunat' => $detalles['codProdSunat'],
                    'descripcion' => $detalles['descripcion'],
                    'unidad' => $detalles['unidad'],
                    'cantidad' => $detalles['cantidad'],
                ]);
            }
            foreach ($request->addDocs ?? [] as $docs) {
                # code...
                Adicionales::create([
                    'id_despatch' => $id_despatch,
                    'tipoDesc' => $docs['tipoDesc'],
                    'tipo' => $docs['tipo'],
                    'nro' => $docs['nro'],
                    'emisor' => $docs['emisor'],
                ]);
            }

            $shipment = new Shipment();
            $envio = $request->envio;
            $motTraslado = MotivoTraslado::where('codTraslado', $envio['codTraslado'])->first()->id;
            $modTraslado = ModalidadTraslado::where('modTraslado', $envio['modTraslado'])->first()->id;


            $shipment->pesoItems = 0;
            $shipment->pesoTotal = $envio['pesoTotal'];
            $shipment->undPesoTotal = $envio['undPesoTotal'];
            $shipment->numBultos = $envio['numBultos'];
            $shipment->fecTraslado = $envio['fecTraslado'];
            $shipment->fecInicioTrasladoBienes = $envio['fecInicioTrasladoBienes'] ?? null;
            $shipment->estado = 'V';
            $shipment->id_puerto = null;
            $shipment->id_aeropuerto = null;
            $shipment->id_mottraslado = $motTraslado;
            $shipment->id_modtraslado = $modTraslado;
            $shipment->id_despatch = $id_despatch;
            if ($envio['transportista']) {
                if ($envio['transportista']['numDoc'] === '') {
                    $shipment->id_transportista = null;
                } else {
                    $shipment->id_transportista = $envio['transportista']['id'];
                }
            } else {
                $shipment->id_transportista = null;
            }

            $shipment->save();
            $id_shipment = $shipment->id;

            foreach ($envio['indicadores'] ?? [] as $ind) {
                # code...
                $idIndicador = Indicadores::where('indicador', $ind)->first()->id;

                ShipmentIndicadores::create([
                    'id_shipment' => $id_shipment,
                    'id_indicadores' => $idIndicador
                ]);
            }

            $partida = $envio['partida'];
            $llegada = $envio['llegada'];

            if ($partida) {
                ShipmentPuntoubicacion::create([
                    'id_shipment' => $id_shipment,
                    'id_puntoubicacion' => $this->idPuntoUbicacion($partida),
                    'ubigeo' => $partida['ubigeo'],
                    'direccion' => $partida['direccion'],
                    'codLocal' => $partida['codLocal'],
                    'ruc' => $partida['ruc'],
                    'tipo' => 'P'
                ]);
            }

            if ($llegada) {
                ShipmentPuntoubicacion::create([
                    'id_shipment' => $id_shipment,
                    'id_puntoubicacion' => $this->idPuntoUbicacion($llegada),
                    'ubigeo' => $llegada['ubigeo'],
                    'direccion' => $llegada['direccion'],
                    'codLocal' => $llegada['codLocal'],
                    'ruc' => $llegada['ruc'],
                    'tipo' => 'L'
                ]);
            }

            $vehiculo = $envio['vehiculo'];
            if ($vehiculo) {
                ShipmentVehiculo::create([
                    'id_shipment' => $id_shipment,
                    'id_vehiculo' => $vehiculo['id'],
                    'tipo' => 'P'
                ]);
                $secundarios = $vehiculo['secundarios'] ?? [];

                if ($secundarios) {
                    foreach ($secundarios as $secu) {
                        # code...
                        ShipmentVehiculo::create([
                            'id_shipment' => $id_shipment,
                            'id_vehiculo' => $secu['id'],
                            'tipo' => 'S'
                        ]);
                    }
                }
            }

            foreach ($envio['choferes'] ?? [] as $chofer) {
                ShipmentConductor::create([
                    'id_shipment' => $id_shipment,
                    'id_conductor' => $chofer['id'],
                    'tipo' => $chofer['tipo']
                ]);
            }

            DB::table('numeracion')
                ->where('serie', $request->serie)
                ->update(['numeroActual' => $request->correlativo]);

            $estadoelectronico = new EstadoElectronico();
            $estadoelectronico->id_despatch = $id_despatch;
            $estadoelectronico->serie = $request->serie;
            $estadoelectronico->numero = $request->correlativo;
            $estadoelectronico->fecha = $request->fechaEmision;
            $estadoelectronico->estado = 'P';
            $estadoelectronico->estadoSunat = '';
            $estadoelectronico->descripcion = 'PENDIENTE DE ENVIO';
            $estadoelectronico->rutaXml = '';
            $estadoelectronico->rutaPdf = '';
            $estadoelectronico->rutaCdr = '';
            $estadoelectronico->cdrbase64 = '';
            $estadoelectronico->hash = '';
            $estadoelectronico->hashQr = '';
            $estadoelectronico->token = '';
            $estadoelectronico->ticket = '';
            $estadoelectronico->save();

            DB::commit();

            $respuesta = [
                'message' => "Guia electrónica con id {$id_shipment} insertada con éxito",
                'despatch' => $despatch,
                'exito' => true,
                'electronico' => $estadoelectronico->id
            ];

            // "Guardar y enviar". Sin `enviar` la guía queda guardada como
            // borrador (estado P), igual que antes.
            if ($request->boolean('enviar')) {
                $respuesta['envio'] = $this->enviarAApi($despatch);
            }

            return $respuesta;
        } catch (QueryException $e) {
            // Última red: el índice único de la base rechazó la guía repetida.
            DB::rollBack();

            if ($this->esDuplicadoSerieCorrelativo($e)) {
                return $this->respuestaDuplicado($request->serie, $request->correlativo);
            }

            if ($this->esDuplicadoScop($e)) {
                return $this->respuestaScopOcupado(Scop::ocupados($scops));
            }

            return response()->json(['error' => 'Error al guardar los datos', 'message' => $e->getMessage(), 'exito' => false], 500);
        } catch (\Throwable $e) {
            // \Throwable y no \Exception: los TypeError y demás Error de PHP 8 no
            // son Exception y dejaban la transacción abierta sin rollback.
            DB::rollBack();
            return response()->json([
                'error' => 'Error al guardar los datos',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'exito' => false,
            ], 500);
        }
    }

    /**
     * Id del punto en el CATÁLOGO (tabla puntoubicacion).
     *
     * Al editar una guía el frontend reenvía lo que devolvió show(), y ahí el
     * punto viene con `id_puntoubicacion`. Se prefiere ese campo sobre `id`
     * porque durante un tiempo `id` fue el de la fila pivote de
     * shipment_puntoubicacions, lo que reventaba la clave foránea.
     *
     * El 0 es la convención ya existente para un punto no catalogado.
     */
    private function idPuntoUbicacion(array $punto)
    {
        $id = (int) ($punto['id_puntoubicacion'] ?? $punto['id'] ?? 0);

        return $id === 0 ? 1 : $id;
    }

    /**
     * ¿La excepción es realmente el índice único de serie + correlativo?
     *
     * No basta con mirar el SQLSTATE: el 23000 lo comparten las claves foráneas
     * y los NOT NULL, y confundirlos hace que cualquier fallo de integridad se
     * reporte como "guía duplicada" y se pierda el error de verdad.
     */
    private function esDuplicadoSerieCorrelativo(QueryException $e)
    {
        // 1062 = Duplicate entry (MySQL)
        return ($e->errorInfo[1] ?? null) === 1062
            && str_contains($e->getMessage(), 'unique_serie_correlativo');
    }

    /**
     * ¿La excepción es el índice único de scop.nroScop?
     */
    private function esDuplicadoScop(QueryException $e)
    {
        return ($e->errorInfo[1] ?? null) === 1062
            && str_contains($e->getMessage(), 'scop_nroscop_unico');
    }

    /**
     * Respuesta cuando uno o más números de SCOP ya están en otra guía.
     */
    private function respuestaScopOcupado($ocupados)
    {
        $detalle = Scop::detalle($ocupados);

        /**
         * Algún número de SCOP ya está en otra guía: la guía no se guardó.
         * `scops` lista cuáles y en qué guía (serie-correlativo) están.
         *
         * @status 409
         * @body array{error: string, message: string, scops: array<int, array{nroScop: string, id_despatch: int, guia: string|null}>, exito: bool}
         */
        return response()->json([
            'error' => 'Número de SCOP ya usado en otra guía.',
            'message' => 'Ya están registrados: ' . $detalle->pluck('nroScop')->implode(', '),
            'scops' => $detalle,
            'exito' => false,
        ], 409);
    }

    /**
     * Respuesta cuando la serie-correlativo ya existe: 409 en vez de crear otra fila.
     *
     * $ignorarId permite excluir la propia guía cuando esto se llama desde update().
     */
    private function respuestaDuplicado($serie, $correlativo, $existente = null, $ignorarId = null)
    {
        $existente = $existente ?: Despatch::where('serie', $serie)
            ->where('correlativo', $correlativo)
            ->when($ignorarId, fn ($q) => $q->where('id', '!=', $ignorarId))
            ->first();

        return response()->json([
            'error' => 'Ya existe un despacho con esta serie y correlativo.',
            'message' => "La guía $serie-$correlativo ya fue registrada" . ($existente ? " con el id {$existente->id}." : '.'),
            'despatch' => $existente,
            'exito' => false,
        ], 409);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Despatch  $despatch
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $user = Auth::user();
        $id_user = $user->id;

        $despatch = Despatch::with(['envio', 'details', 'docsadicionales', 'clientes', 'terceros', 'compradores', 'envio.indicadores', 'envio.ubicaciones', 'envio.vehiculos', 'envio.conductores', 'envio.transportista', 'electronico'])->findOrFail($id);
        if ($despatch->electronico->estado === 'F' || $despatch->electronico->estado === 'B') {
            return response()->json(['error' => 'Ya no se puede modificar la Guía, verifique el estado', 'exito' => false], 403);
        }

        if ($user->perfil === 'admin') {
            return new DespatchResource($despatch);
        } else {
            if ($id_user === $despatch->id_user) {
                return new DespatchResource($despatch);
            } else {
                return response()->json(['error' => 'No se puede mostrar la guía, este usuario no tiene permisos', 'exito' => false], 403);
            }
        }
    }

    public function showpdf($id)
    {
        $despatch = Despatch::with(['envio', 'details', 'docsadicionales', 'clientes', 'terceros', 'compradores', 'envio.indicadores', 'envio.ubicaciones', 'envio.vehiculos', 'envio.conductores', 'envio.transportista', 'electronico'])->findOrFail($id);
        return new DespatchResource($despatch);
    }

    /**
     * Dar de baja una guía
     *
     * Marca el estado electrónico como 'B' y libera sus números de SCOP, que
     * quedan disponibles para otra guía.
     */
    public function baja($id)
    {
        $despatch = EstadoElectronico::where('id_despatch', $id)->first();

        if (! $despatch) {
            return response()->json([
                'error' => "No existe el estado electrónico de la guía con id $id",
                'exito' => false,
            ], 404);
        }

        DB::beginTransaction();

        try {
            $despatch->estado = 'B';
            $despatch->descripcion = 'La Guia ha sido dada de baja';

            $despatch->save();

            // Los números de SCOP vuelven a quedar libres
            $scopsLiberados = Scop::where('id_despatch', $id)->pluck('nroScop');
            Scop::where('id_despatch', $id)->delete();

            DB::commit();

            $despatch->refresh();

            return [
                'message' => "Guia electrónica con id {$despatch->id} se ha dado de baja",
                'despatch' => $despatch,
                'scopsLiberados' => $scopsLiberados,
                'exito' => true,
            ];
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'Error al dar de baja la guía',
                'message' => $e->getMessage(),
                'exito' => false,
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Despatch  $despatch
     * @return \Illuminate\Http\Response
     */
    public function edit(Despatch $despatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Despatch  $despatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $despatch = Despatch::find($id);

        if (! $despatch) {
            return response()->json([
                'error' => "No existe la guía con id $id",
                'exito' => false,
            ], 404);
        }

        // Ya está en SUNAT (o esperando su respuesta): editarla dejaría los
        // datos locales distintos de lo declarado.
        $electronico = EstadoElectronico::where('id_despatch', $despatch->id)->first();
        $bloqueados = array_merge(FacturacionApiService::EN_PROCESO, FacturacionApiService::FINALES);
        if ($electronico && in_array($electronico->fe_estado, $bloqueados, true)) {
            return response()->json([
                'error' => 'La guía ya fue enviada a SUNAT y no se puede modificar.',
                'message' => $electronico->descripcion,
                'exito' => false,
            ], 409);
        }

        // Si el campo no viene en la petición no se toca lo ya guardado
        $enviaScops = $request->has('scops') || $request->has('nroScop');
        $scops = $enviaScops
            ? Scop::normalizar($request->input('scops', $request->input('nroScop')))
            : [];

        DB::beginTransaction();

        try {
            // Actualizar el despatch
            // $despatch->update([
            //     'version' => $request->version,
            //     'correlativo' => $request->correlativo,
            //     'serie' => $request->serie,
            //     'observacion' => $request->observacion ?? '',
            //     'fechaEmision' => $request->fechaEmision,
            //     'id_cliente' => $request->destinatario['id'] ?? null,
            //     'id_tercero' => $request->tercero['id'] ?? null,
            //     'id_comprador' => $request->comprador['id'] ?? null,
            // ]);
            $despatch->update([
                'version' => $request->version,
                'correlativo' => $request->correlativo,
                'serie' => $request->serie,
                'observacion' => $request->observacion ?? '',
                'fechaEmision' => $request->fechaEmision,
                'id_cliente' => $request->destinatario ? ($request->destinatario['id'] ?? null) : null,
                'id_tercero' => $request->tercero ? ($request->tercero['id'] ?? null) : null,
                'id_comprador' => $request->comprador ? ($request->comprador['id'] ?? null) : null,
            ]);

            // SCOP: se reemplazan los de la guía. Los que ya eran suyos no
            // cuentan como ocupados.
            if ($enviaScops) {
                $ocupados = Scop::ocupados($scops, $despatch->id, true);

                if ($ocupados->isNotEmpty()) {
                    DB::rollBack();

                    return $this->respuestaScopOcupado($ocupados);
                }

                Scop::where('id_despatch', $despatch->id)->whereNotIn('nroScop', $scops)->delete();

                foreach ($scops as $nroScop) {
                    Scop::firstOrCreate(
                        ['nroScop' => $nroScop],
                        ['id_despatch' => $despatch->id]
                    );
                }
            }

            // Actualizar detalles del despatch
            DespatchProducto::where('id_despatch', $despatch->id)->delete();
            foreach ($request->details ?? [] as $detalles) {
                DespatchProducto::create([
                    'id_despatch' => $despatch->id,
                    'id_producto' => $detalles['id'] === 0 ? 1 : $detalles['id'],
                    'codigo' => $detalles['codigo'],
                    'codProdSunat' => $detalles['codProdSunat'],
                    'descripcion' => $detalles['descripcion'],
                    'unidad' => $detalles['unidad'],
                    'cantidad' => $detalles['cantidad'],
                ]);
            }

            // Actualizar documentos adicionales
            Adicionales::where('id_despatch', $despatch->id)->delete();
            foreach ($request->addDocs ?? [] as $docs) {
                Adicionales::create([
                    'id_despatch' => $despatch->id,
                    'tipoDesc' => $docs['tipoDesc'],
                    'tipo' => $docs['tipo'],
                    'nro' => $docs['nro'],
                    'emisor' => $docs['emisor'],
                ]);
            }

            // Actualizar el envío
            $envio = $request->envio;
            $shipment = Shipment::where('id_despatch', $despatch->id)->first();

            $motTraslado = MotivoTraslado::where('codTraslado', $envio['codTraslado'])->first()->id;
            $modTraslado = ModalidadTraslado::where('modTraslado', $envio['modTraslado'])->first()->id;

            $shipment->update([
                'pesoTotal' => $envio['pesoTotal'],
                'undPesoTotal' => $envio['undPesoTotal'],
                'numBultos' => $envio['numBultos'],
                'fecTraslado' => $envio['fecTraslado'],
                'fecInicioTrasladoBienes' => $envio['fecInicioTrasladoBienes'] ?? null,
                'id_mottraslado' => $motTraslado,
                'id_modtraslado' => $modTraslado,
                // 'id_transportista' => $envio['transportista']['id'] ?? null,
                'id_transportista' => isset($envio['transportista']['id']) ? $envio['transportista']['id'] : null,
            ]);

            // Actualizar indicadores del envío
            ShipmentIndicadores::where('id_shipment', $shipment->id)->delete();
            foreach ($envio['indicadores'] ?? [] as $ind) {
                $idIndicador = Indicadores::where('indicador', $ind)->first()->id;
                ShipmentIndicadores::create([
                    'id_shipment' => $shipment->id,
                    'id_indicadores' => $idIndicador,
                ]);
            }

            // Actualizar ubicaciones de partida y llegada
            ShipmentPuntoubicacion::where('id_shipment', $shipment->id)->delete();
            if ($envio['partida']) {
                ShipmentPuntoubicacion::create([
                    'id_shipment' => $shipment->id,
                    'id_puntoubicacion' => $this->idPuntoUbicacion($envio['partida']),
                    'ubigeo' => $envio['partida']['ubigeo'],
                    'direccion' => $envio['partida']['direccion'],
                    'codLocal' => $envio['partida']['codLocal'],
                    'ruc' => $envio['partida']['ruc'],
                    'tipo' => 'P',
                ]);
            }
            if ($envio['llegada']) {
                ShipmentPuntoubicacion::create([
                    'id_shipment' => $shipment->id,
                    'id_puntoubicacion' => $this->idPuntoUbicacion($envio['llegada']),
                    'ubigeo' => $envio['llegada']['ubigeo'],
                    'direccion' => $envio['llegada']['direccion'],
                    'codLocal' => $envio['llegada']['codLocal'],
                    'ruc' => $envio['llegada']['ruc'],
                    'tipo' => 'L',
                ]);
            }

            // Actualizar vehículos
            ShipmentVehiculo::where('id_shipment', $shipment->id)->delete();
            if ($envio['vehiculo']) {
                ShipmentVehiculo::create([
                    'id_shipment' => $shipment->id,
                    'id_vehiculo' => $envio['vehiculo']['id'],
                    'tipo' => 'P',
                ]);
                // Un vehículo sin secundarios puede llegar con null
                foreach ($envio['vehiculo']['secundarios'] ?? [] as $secu) {
                    ShipmentVehiculo::create([
                        'id_shipment' => $shipment->id,
                        'id_vehiculo' => $secu['id'],
                        'tipo' => 'S',
                    ]);
                }
            }

            // Actualizar conductores
            ShipmentConductor::where('id_shipment', $shipment->id)->delete();
            foreach ($envio['choferes'] ?? [] as $chofer) {
                ShipmentConductor::create([
                    'id_shipment' => $shipment->id,
                    'id_conductor' => $chofer['id'],
                    'tipo' => $chofer['tipo'],
                ]);
            }


            // Actualizar estado electrónico
            $estadoelectronico = EstadoElectronico::where('id_despatch', $despatch->id)->first();


            DB::commit();

            $respuesta = [
                'message' => "Guia electrónica con id {$shipment->id} actualizada con éxito",
                'despatch' => $despatch,
                'exito' => true,
                'electronico' => $estadoelectronico->id,
            ];

            if ($request->boolean('enviar')) {
                $respuesta['envio'] = $this->enviarAApi($despatch);
            }

            return response()->json($respuesta);
        } catch (QueryException $e) {
            DB::rollBack();

            if ($this->esDuplicadoSerieCorrelativo($e)) {
                return $this->respuestaDuplicado($request->serie, $request->correlativo, null, $id);
            }

            if ($this->esDuplicadoScop($e)) {
                return $this->respuestaScopOcupado(Scop::ocupados($scops, $id));
            }

            return response()->json([
                'error' => 'Error al actualizar los datos',
                'message' => $e->getMessage(),
                'sql' => $e->getSql(),
                'exito' => false,
                'line' => $e->getLine(),
            ], 500);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error al actualizar los datos',
                'message' => $e->getMessage(),
                'exito' => false,
                'line' => $e->getLine()
            ], 500);
        }
    }


    /**
     * Enviar una guía guardada a SUNAT
     *
     * Para las guías que se guardaron como borrador ("guardar" sin enviar).
     * La envía por la API de facturación según en qué punto esté:
     * - nueva o rechazada: se envía con los datos actuales (una rechazada se
     *   corrige antes con PUT y se reenvía con el mismo número);
     * - con error de envío: se reintenta;
     * - esperando respuesta de SUNAT: solo se consulta;
     * - aceptada o dada de baja: 409.
     *
     * El resultado final llega después por webhook; mientras tanto
     * `electronico.feEstado` es `pendingTicket`.
     */
    public function enviar($id, FacturacionApiService $service)
    {
        $despatch = Despatch::with('electronico')->find($id);

        if ($error = $this->sinAcceso($despatch, $id)) {
            return $error;
        }

        $resultado = $service->enviar($despatch);

        return response()->json($this->resumenEnvio($resultado), $resultado['http']);
    }

    /**
     * Consultar el estado de la guía en SUNAT
     *
     * Pregunta a la API de facturación (y, si sigue pendiente, consulta el
     * ticket en SUNAT) y actualiza el estado electrónico. Útil si el webhook no
     * llegó.
     */
    public function consultar($id, FacturacionApiService $service)
    {
        $despatch = Despatch::with('electronico')->find($id);

        if ($error = $this->sinAcceso($despatch, $id)) {
            return $error;
        }

        $resultado = $service->consultar($despatch);

        return response()->json($this->resumenEnvio($resultado), $resultado['http']);
    }

    /**
     * Descargar PDF, XML o CDR de la guía
     *
     * Lo obtiene de la API de facturación. `tipo`: `pdf` (defecto), `xml` o
     * `cdr`. `formato` (solo pdf): `a4` (defecto) o `sunat`, el PDF que
     * entrega SUNAT en el enlace del QR. Si la API no lo tiene (en beta su
     * enlace no es de SUNAT), se baja directo del enlace guardado en la guía;
     * 404/503 si aún no hay. Con `descargar=1` se descarga en vez de abrirse.
     */
    public function archivo(Request $request, $id, FacturacionApiService $service)
    {
        $request->validate([
            'tipo' => 'sometimes|in:pdf,xml,cdr',
            'formato' => 'sometimes|in:a4,sunat',
        ]);

        $despatch = Despatch::with('electronico')->find($id);

        if ($error = $this->sinAcceso($despatch, $id)) {
            return $error;
        }

        $estado = $despatch->electronico;

        if (! $estado || ! $estado->fe_id) {
            return response()->json(['error' => 'La guía no se ha enviado por la API de facturación.', 'exito' => false], 409);
        }

        if ($falta = $service->faltaConfigurar()) {
            return response()->json(['error' => $falta, 'exito' => false], 503);
        }

        $tipo = $request->input('tipo', 'pdf');
        $sunat = $tipo === 'pdf' && $request->input('formato') === 'sunat';
        $extension = ['pdf' => 'pdf', 'xml' => 'xml', 'cdr' => 'zip'][$tipo];
        $nombre = ($sunat ? 'SUNAT-' : '') . "{$despatch->serie}-{$despatch->correlativo}.{$extension}";
        $disposicion = $request->boolean('descargar') ? 'attachment' : 'inline';

        try {
            $respuesta = $service->archivo($estado, $tipo, $sunat ? 'sunat' : 'a4');
        } catch (ConnectionException $e) {
            $respuesta = null;
        }

        // PDF de SUNAT: si la API no lo tiene (404, p. ej. en beta) o no responde,
        // directo del enlace del QR. Con 503 no: la API ya intentó con SUNAT y
        // no lo entregó, volver a pedirlo solo duplica la espera.
        $apiSinPdf = ! $respuesta || $respuesta->status() === 404;
        if ($sunat && $apiSinPdf && ($pdf = $service->pdfSunatDirecto($estado))) {
            return response($pdf, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => "$disposicion; filename=\"$nombre\"",
            ]);
        }

        if (! $respuesta) {
            return response()->json(['error' => 'No se pudo contactar a la API de facturación.', 'exito' => false], 502);
        }

        if (! $respuesta->successful()) {
            // 404 = aún no hay archivo (p. ej. PDF de SUNAT antes de aceptarse); 503 = SUNAT no responde
            $http = in_array($respuesta->status(), [404, 503], true) ? $respuesta->status() : 502;

            return response()->json([
                'error' => $respuesta->json('message') ?? $respuesta->json('error') ?? "La API respondió {$respuesta->status()}",
                'urlQr' => $estado->fe_qr_url,
                'exito' => false,
            ], $http, array_filter(['Retry-After' => $respuesta->header('Retry-After')]));
        }

        return response($respuesta->body(), 200, [
            'Content-Type' => $respuesta->header('Content-Type') ?: 'application/octet-stream',
            'Content-Disposition' => "$disposicion; filename=\"$nombre\"",
        ]);
    }

    /**
     * Envía la guía recién guardada y resume el resultado para el front.
     * Un fallo aquí no deshace el guardado: la guía queda como borrador.
     */
    private function enviarAApi(Despatch $despatch)
    {
        $despatch->load('electronico');

        return $this->resumenEnvio(app(FacturacionApiService::class)->enviar($despatch));
    }

    private function resumenEnvio(array $resultado)
    {
        $estado = $resultado['estado'];

        return [
            'exito' => $resultado['exito'],
            'message' => $resultado['message'],
            'errors' => $resultado['errors'],
            'electronico' => $estado ? [
                'id' => $estado->id,
                'estado' => $estado->estado,
                'estadoSunat' => $estado->estadoSunat,
                'codigoSunat' => $estado->codigoSunat,
                'descripcion' => $estado->descripcion,
                'feId' => $estado->fe_id,
                'feEstado' => $estado->fe_estado,
                'feQrUrl' => $estado->fe_qr_url,
                'ticket' => $estado->ticket,
            ] : null,
        ];
    }

    /**
     * Misma regla que show(): el admin ve todo, el resto solo sus guías.
     */
    private function sinAcceso($despatch, $id)
    {
        if (! $despatch) {
            return response()->json(['error' => "No existe la guía con id $id", 'exito' => false], 404);
        }

        $user = Auth::user();

        if ($user->perfil !== 'admin' && $user->id !== $despatch->id_user) {
            return response()->json(['error' => 'Este usuario no tiene permisos sobre la guía', 'exito' => false], 403);
        }

        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Despatch  $despatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Despatch $despatch)
    {
        //
    }
}
