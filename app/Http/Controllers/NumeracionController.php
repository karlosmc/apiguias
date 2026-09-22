<?php

namespace App\Http\Controllers;

use App\Http\Requests\NumeracionRequest;
use Exception;
use App\Models\Numeracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\NumeracionVehiculos;
use App\Http\Resources\NumeracionResource;
use Illuminate\Support\Facades\Auth;

class NumeracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $numeracion = Numeracion::with(['vehiculoPrimario', 'vehiculosSecundarios', 'puntoEmision'])->get();
        return  NumeracionResource::collection($numeracion);
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

    public function actualizar($id)
    {


        $numeracion = Numeracion::findOrFail($id);

        $numeracion->numeroActual = $numeracion->numeroActual + 1;
        $numeracion->save();
        $numeracion->refresh();
        return [
            'message' => 'Numeración actualizada',
            'numeracion' => $numeracion
        ];
    }

    public function getSeriesByUser()
    {

        $id = Auth::user()->id;

        $numeracion = Numeracion::join('users_puntoemision as up', 'up.id_puntoemision', '=', 'numeracion.id_puntoemision')
            ->where('up.id_users', $id)
            ->select('serie')
            ->get();

        return $numeracion;
    }

    public function actualbypunto(Request $request)
    {
        $query = Numeracion::query();

        if ($request->has('id_puntoemision')) {
            $query->where('id_puntoemision', $request->input('id_puntoemision'));
        }

        $query->with(['vehiculoPrimario', 'vehiculosSecundarios']);

        return NumeracionResource::collection($query->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NumeracionRequest $request)
    {
        //

        $request->validated();
        DB::beginTransaction();

        try {
            //code...
            $numeracion = new Numeracion();
            $numeracion->nombre = $request->nombre;
            $numeracion->serie = $request->serie;
            $numeracion->numeroActual = $request->numeroActual;
            $numeracion->id_puntoemision = $request->id_puntoemision;
            $numeracion->save();
            $id = $numeracion->id;

            if (isset($request->primario)) {
                NumeracionVehiculos::create([
                    'id_numeracion' => $id,
                    'id_primario' => $request->primario,
                    'id_secundario' => $request->secundario,
                ]);
            }

            DB::commit();
            return [
                'message' => "Numeración con $id registrada con éxito",
                'numeracion' => $numeracion
            ];
        } catch (Exception $e) {
            //throw $th;
            DB::rollBack();
            return response()->json(['error' => 'Error al insertar los datos', 'message' => $e->getMessage(), 'exito' => false], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        DB::beginTransaction();

        try {
            //code...
            $numeracion = Numeracion::find($id);

            $data = $request->all();
            
            
            foreach ($data as $key => $value) {
                if (is_null($value)) {
                    $data[$key] = '';
                }
            }
            

            // $data["id_tipodocumento"] = TipoDocumento::where('tipoDoc',$request->tipoDoc)->value('id');

            NumeracionVehiculos::where('id_numeracion', $numeracion->id)->delete();

            if (isset($request->primario)) {
                NumeracionVehiculos::create([
                    'id_numeracion' => $numeracion->id,
                    'id_primario' => $request->primario,
                    'id_secundario' => $request->secundario,
                ]);
            }
            $numeracion->update($data);
            $numeracion->refresh();
            DB::commit();
            
            return [
                'message' => 'Numeración actualizada',
                'numeracion' => $numeracion
            ];
        } catch (Exception $e) {
            //throw $th;
            DB::rollBack();
            return response()->json(['error' => 'Error al actualizar los datos', 'message' => $e->getMessage(), 'exito' => false], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
