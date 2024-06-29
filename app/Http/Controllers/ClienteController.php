<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;

use App\Http\Resources\ClienteResouce;
use App\Models\Cliente;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return new PedidoCollection(Pedido::with('user')->with('productos')->where('estado',0)->get());
        
        // $clientes = Cliente::all();
        // return new ClienteCollection(Cliente::with('tipoDocumentos')->get());

        $clientes = Cliente::with('tipoDocumentos')->get();

        return ClienteResouce::collection($clientes);
    }

    public function buscar(Request $request){

        $query = Cliente::with("tipoDocumentos");

        if ($request->has('numDoc')) {
            $query->where('numDoc', $request->input('numDoc'));
        }

        if ($request->has('rznSocial')) {
            $query->where('rznSocial', 'like', '%' . $request->input('rznSocial') . '%');
        }

        if ($request->has('fav')) {
            $query->where('fav', $request->input('fav'));
        }

        return ClienteResouce::collection($query->get());

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
    public function store(ClienteRequest $request)
    {

        $request->validated();

      

        $persona = new Cliente();

        $persona->numDoc = $request->numDoc;
        $persona->rznSocial = $request->rznSocial;
        $persona->fav = $request->fav;
        $persona->isCompany = $request->isCompany;
        $persona->email = $request->email;
        $persona->telephone = $request->telephone;
        $persona->nombreCorto = $request->nombreCorto;

        $persona->id_tipodocumento = TipoDocumento::where('tipoDoc',$request->tipoDoc)->value('id');
        
        $persona->save();

        $id = $persona->id;
        

        return [
            'message' => "Persona con id $id Insertado con exito",
            'persona' => $request->all()
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
    public function update(Request $request, Cliente $cliente)
    {
        //

        $data = $request->all();
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                $data[$key] = '';
            }
        }

        $data["id_tipodocumento"] = TipoDocumento::where('tipoDoc',$request->tipoDoc)->value('id');
        $cliente->update($data);
        $cliente->refresh();
        return [
            'cliente' => $cliente
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
