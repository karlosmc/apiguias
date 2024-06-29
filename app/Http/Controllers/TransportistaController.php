<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransportistaRequest;
use App\Http\Resources\TransportistaResource;
use App\Models\TipoDocumento;
use App\Models\Transportista;
use Illuminate\Http\Request;

class TransportistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $transportistas = Transportista::with('tipoDocumentos')->get();

        return TransportistaResource::collection($transportistas);
    }

    public function buscar(Request $request){

        $query = Transportista::with("tipoDocumentos");

        if ($request->has('numDoc')) {
            $query->where('numDoc', $request->input('numDoc'));
        }

        if ($request->has('rznSocial')) {
            $query->where('rznSocial', 'like', '%' . $request->input('rznSocial') . '%');
        }

        if ($request->has('fav')) {
            $query->where('fav', $request->input('fav'));
        }

        return TransportistaResource::collection($query->get());

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
    public function store(TransportistaRequest $request)
    {
        $request->validated();

      

        $transportista = new Transportista();

        $transportista->numDoc = $request->numDoc;
        $transportista->rznSocial = $request->rznSocial;
        $transportista->fav = $request->fav;
        $transportista->nombreCorto = $request->nombreCorto;
        $transportista->id_tipodocumento = TipoDocumento::where('tipoDoc',$request->tipoDoc)->value('id');
        $transportista->nroMtc = $request->nroMtc;
        $transportista->save();
        $id = $transportista->id;

        return [
            'message' => "transportista con id $id Insertado con exito",
            'transportista' => $request->all()
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
    public function update(Request $request, Transportista $transportista)
    {
        //

        $data = $request->all();
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                $data[$key] = '';
            }
        }

        $data["id_tipodocumento"] = TipoDocumento::where('tipoDoc',$request->tipoDoc)->value('id');
        $transportista->update($data);
        $transportista->refresh();
        return [
            'transportista' => $transportista
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
