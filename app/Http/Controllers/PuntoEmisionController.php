<?php

namespace App\Http\Controllers;

use App\Http\Resources\PuntoEmisionCollection;
use App\Models\Empresa;
use App\Models\PuntoEmision;
use Illuminate\Http\Request;

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
        return new PuntoEmisionCollection(PuntoEmision::all());
        
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

        $puntoemision = new PuntoEmision();

        $ruc = Empresa::all()->first()->ruc;

        $puntoemision->codigo=$request->codigo;
        $puntoemision->nombre=$request->nombre;
        $puntoemision->codLocal=$request->codLocal;
        $puntoemision->direccion=$request->direccion;
        $puntoemision->ruc=$ruc;

        $puntoemision->save();

        $id = $puntoemision->id;

        return [
            'message'=>"El punto de emisión con id $id Insertado correctamente",
            'puntoemision'=>$puntoemision
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
