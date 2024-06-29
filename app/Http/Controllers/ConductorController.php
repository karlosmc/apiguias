<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use Illuminate\Http\Request;
use App\Models\TipoDocumento;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ConductorRequest;
use App\Http\Resources\ConductorResource;

class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $conductores = Conductor::with('tipoDocumentos')->get();

        return ConductorResource::collection($conductores);
    }


    public function buscar(Request $request)
    {

        $query = Conductor::with("tipoDocumentos");

        if ($request->has('nroDoc')) {
            $query->where('nroDoc', $request->input('nroDoc'));
        }

        if ($request->has('nombres')) {
            $query->where('nombres', 'like', '%' . $request->input('nombres') . '%');
        }

        if ($request->has('apellidos')) {
            $query->where('apellidos', 'like', '%' . $request->input('apellidos') . '%');
        }
        if ($request->has('licencia')) {
            $query->where('licencia', 'like', '%' . $request->input('licencia') . '%');
        }

        if ($request->has('fav')) {
            $query->where('fav', $request->input('fav'));
        }

        return ConductorResource::collection($query->get());
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
    public function store(ConductorRequest $request)
    {
        //

        $request->validated();



        $conductor = new Conductor();

        $conductor->nroDoc = $request->nroDoc;
        $conductor->fav = $request->fav;
        $conductor->isCompany = $request->isCompany;
        $conductor->nombres = $request->nombres;
        $conductor->apellidos = $request->apellidos;
        $conductor->nombreCorto = $request->nombreCorto;
        $conductor->licencia = $request->licencia;

        $conductor->id_tipodocumento = TipoDocumento::where('tipoDoc', $request->tipoDoc)->value('id');

        $conductor->save();

        $id = $conductor->id;


        return [
            'message' => "Conductor con id $id Insertado con exito",
            'conductor' => $request->all()
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
    public function update(Request $request,Conductor $conductor)
    {
        // DB::enableQueryLog();
        //

        $data = $request->all();
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                $data[$key] = '';
            }
        }

        // $conductor_update= Conductor::find($data['id']);



        $data["id_tipodocumento"] = TipoDocumento::where('tipoDoc', $request->tipoDoc)->value('id');

        // $conductor->fill($data);

        $conductor->update($data);
        $conductor->refresh();
        return [
            'conductor' => $conductor,
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
