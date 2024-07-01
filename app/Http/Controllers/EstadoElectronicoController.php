<?php

namespace App\Http\Controllers;

use App\Http\Resources\EstadoElectronicoCollection;
use App\Http\Resources\EstadoElectronicoResource;
use App\Models\EstadoElectronico;
use Illuminate\Http\Request;

class EstadoElectronicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $estadoElectronico = EstadoElectronico::all();
        return new EstadoElectronicoCollection($estadoElectronico);
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
    public function update(Request $request,$id)
    {
        //
        $estadoElectronico = EstadoElectronico::find($id);

        $data = $request->only($estadoElectronico->getFillable());

        // print_r($estadoElectronico::all());

        // $data["id_tipodocumento"] = TipoDocumento::where('tipoDoc',$request->tipoDoc)->value('id');
        $estadoElectronico->update($data);
        $estadoElectronico->refresh();
        return [
            'electronico' => $estadoElectronico
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
