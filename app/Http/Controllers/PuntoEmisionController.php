<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\PuntoEmision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Database\Seeders\PuntoEmisionSeeder;
use App\Http\Resources\PuntoEmisionResource;
use App\Http\Resources\PuntoEmisionCollection;
use App\Models\UsersPuntoemision;
use Exception;

class PuntoEmisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $puntoemision = PuntoEmision::with('users')->get();
        return PuntoEmisionResource::collection($puntoemision);
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
            $puntoemision = new PuntoEmision();

            $ruc = Empresa::all()->first()->ruc;

            $puntoemision->codigo = $request->codigo;
            $puntoemision->nombre = $request->nombre;
            $puntoemision->codLocal = $request->codLocal;
            $puntoemision->direccion = $request->direccion;
            $puntoemision->ruc = $ruc;

            $puntoemision->save();

            $id = $puntoemision->id;


            // UsersPuntoemision::where('id_puntoemision', $request->id)->delete();

            foreach ($request->users as $user) {
                # code...
                UsersPuntoemision::create([
                    'id_users' => $user['id'],
                    'id_puntoemision' => $id
                ]);
            }

            DB::commit();
            return [
                'message' => "El punto de emisión con id $id Insertado correctamente",
                'puntoemision' => $puntoemision
            ];
        } catch (Exception $e) {
            //throw $th;
            DB::rollBack();
            return response()->json(['error' => 'Error al actualizar los datos', 'message' => $e->getMessage(), 'exito' => false], 500);
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

        $puntoEmision = PuntoEmision::find($id);

        $data = $request->all();
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                $data[$key] = '';
            }
        }

        // $data["id_tipodocumento"] = TipoDocumento::where('tipoDoc',$request->tipoDoc)->value('id');

        UsersPuntoemision::where('id_puntoemision', $puntoEmision->id)->delete();

        foreach ($request->users as $user) {
            # code...
            UsersPuntoemision::create([
                'id_users' => $user['id'],
                'id_puntoemision' => $puntoEmision->id
            ]);
        }
        $puntoEmision->update($data);
        $puntoEmision->refresh();


        return [
            'puntoemision' => $puntoEmision
        ];
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
