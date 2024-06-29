<?php

namespace App\Http\Controllers;

use App\Http\Resources\DespatchCollection;
use App\Models\Adicionales;
use App\Models\Despatch;
use App\Models\DespatchProducto;
use App\Models\EstadoElectronico;
use App\Models\Indicadores;
use App\Models\ModalidadTraslado;
use App\Models\MotivoTraslado;
use App\Models\Numeracion;
use App\Models\Shipment;
use App\Models\ShipmentConductor;
use App\Models\ShipmentIndicadores;
use App\Models\ShipmentPuntoubicacion;
use App\Models\ShipmentVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        return new DespatchCollection(Despatch::with('clientes')->with('terceros')->with('compradores')->with('envio')->get());
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
    public function store(Request $request)
    {
        //
        DB::beginTransaction();

        try {
            //code...
            $despatch = new Despatch();

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

            // print_r($request->version);

            foreach ($request->details as $detalles) {
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
            foreach ($request->addDocs as $docs) {
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

            foreach ($envio['indicadores'] as $ind) {
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
                    'id_puntoubicacion' => $partida['id'] === 0 ? 1 : $partida['id'],
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
                    'id_puntoubicacion' => $llegada['id'] === 0 ? 1 : $llegada['id'],
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
                $secundarios = $vehiculo['secundarios'];

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

            foreach ($envio['choferes'] as $chofer) {
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

            return [
                'message' => "Guia electrónica con id {$id_shipment} insertada con éxito",
                'despatch' => $despatch,
                'exito' => true,
                'electronico' => $estadoelectronico->id
            ];
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            return response()->json(['error' => 'Error al guardar los datos', 'message' => $e->getMessage(), 'exito' => false], 500);
        }


        // $despatch





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Despatch  $despatch
     * @return \Illuminate\Http\Response
     */
    public function show(Despatch $despatch)
    {
        //
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
    public function update(Request $request, Despatch $despatch)
    {
        DB::beginTransaction();
    
        try {
            // Actualizar el despatch
            $despatch->update([
                'version' => $request->version,
                'correlativo' => $request->correlativo,
                'serie' => $request->serie,
                'observacion' => $request->observacion ?? '',
                'fechaEmision' => $request->fechaEmision,
                'id_cliente' => $request->destinatario['id'] ?? null,
                'id_tercero' => $request->tercero['id'] ?? null,
                'id_comprador' => $request->comprador['id'] ?? null,
            ]);
    
            // Actualizar detalles del despatch
            DespatchProducto::where('id_despatch', $despatch->id)->delete();
            foreach ($request->details as $detalles) {
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
            foreach ($request->addDocs as $docs) {
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
                'id_mottraslado' => $motTraslado,
                'id_modtraslado' => $modTraslado,
                'id_transportista' => $envio['transportista']['id'] ?? null,
            ]);
    
            // Actualizar indicadores del envío
            ShipmentIndicadores::where('id_shipment', $shipment->id)->delete();
            foreach ($envio['indicadores'] as $ind) {
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
                    'id_puntoubicacion' => $envio['partida']['id'] === 0 ? 1 : $envio['partida']['id'],
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
                    'id_puntoubicacion' => $envio['llegada']['id'] === 0 ? 1 : $envio['llegada']['id'],
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
                foreach ($envio['vehiculo']['secundarios'] as $secu) {
                    ShipmentVehiculo::create([
                        'id_shipment' => $shipment->id,
                        'id_vehiculo' => $secu['id'],
                        'tipo' => 'S',
                    ]);
                }
            }
    
            // Actualizar conductores
            ShipmentConductor::where('id_shipment', $shipment->id)->delete();
            foreach ($envio['choferes'] as $chofer) {
                ShipmentConductor::create([
                    'id_shipment' => $shipment->id,
                    'id_conductor' => $chofer['id'],
                    'tipo' => $chofer['tipo'],
                ]);
            }
    
            
            // Actualizar estado electrónico
            $estadoelectronico = EstadoElectronico::where('id_despatch', $despatch->id)->first();
  
    
            DB::commit();
    
            return response()->json([
                'message' => "Guia electrónica con id {$shipment->id} actualizada con éxito",
                'despatch' => $despatch,
                'exito' => true,
                'electronico' => $estadoelectronico->id,
            ]);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al actualizar los datos', 'message' => $e->getMessage(), 'exito' => false], 500);
        }
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
