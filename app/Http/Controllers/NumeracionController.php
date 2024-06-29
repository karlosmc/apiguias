<?php

namespace App\Http\Controllers;

use App\Http\Resources\NumeracionResource;
use App\Models\Numeracion;
use Illuminate\Http\Request;

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

    public function actualizar($id){

        
        $numeracion = Numeracion::findOrFail($id);

        $numeracion->numeroActual=$numeracion->numeroActual+1;
        $numeracion->save();
        $numeracion->refresh();
        return [
            'message'=>'Numeración actualizada',
            'numeracion'=>$numeracion
        ];

    }

    public function actualbypunto(Request $request)
    {
        $query = Numeracion::query();

        if ($request->has('id_puntoemision')) {
            $query->where('id_puntoemision', $request->input('id_puntoemision'));
        }
       
        return NumeracionResource::collection($query->get());
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
        $numeracion = new Numeracion();

        $numeracion->nombre = $request->nombre;
        $numeracion->serie = $request->serie;
        $numeracion->numeroActual = $request->numeroActual;
        $numeracion->id_puntoemision = $request->id_puntoemision;
        
        $numeracion->save();

        $id=$numeracion->id;

        return [
            'message'=>"Numeración con $id registrada con éxito",
            'numeracion'=>$numeracion
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
    public function update(Request $request, $id)
    {
        //
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
