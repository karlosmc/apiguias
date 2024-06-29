<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiculoRequest;
use App\Http\Resources\VehiculoCollection;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return new VehiculoCollection(Vehiculo::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function buscar(Request $request)
     {
         $query = Vehiculo::query();
 
         if ($request->has('placa')) {
             $query->where('placa', $request->input('placa'));
         }
 
         if ($request->has('nombreCorto')) {
             $query->where('nombreCorto', 'like', '%' . $request->input('nombreCorto') . '%');
         }

         if ($request->has('fav')) {
            $query->where('fav', $request->input('fav'));
        }
         if ($request->has('isCompany')) {
            $query->where('isCompany', $request->input('isCompany'));
        }

         return new VehiculoCollection($query->get());
     }
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
    public function store(VehiculoRequest $request)
    {
        //

        $request->validated();
        
        $vehiculo = new Vehiculo();

        $vehiculo->placa = strtoupper($request->placa);
        $vehiculo->nroCirculacion = strtoupper($request->nroCirculacion);
        $vehiculo->nroAutorizacion = strtoupper($request->nroAutorizacion);
        $vehiculo->codEmisor = strtoupper($request->codEmisor);
        $vehiculo->fav = $request->fav;
        $vehiculo->isCompany = $request->isCompany;
        $vehiculo->nombreCorto = strtoupper($request->nombreCorto);

        $vehiculo->save();
        $id = $vehiculo->id;

        return [
            'message' => "Vehiculo con id $id Insertado con exito",
            'vehiculo' => $vehiculo
        ];
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
    public function update(Request $request, Vehiculo $vehiculo)
    {
        
        $data = $request->all();
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                $data[$key] = '';
            }
        }
        $vehiculo->update($data);
        return [
            'vehi$vehiculo' => $data
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
