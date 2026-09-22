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
     * Listar clientes
     *
     * Acepta filtros por número de documento o razón social.
     *
     * El campo `fav` de la respuesta es el favorito DEL USUARIO autenticado,
     * no un valor compartido. Se filtra con `?fav=1` (solo favoritos) o
     * `?fav=0` (el resto).
     *
     * `nombreCorto` también es el del usuario: el que él le puso o, si no
     * puso ninguno, el del catálogo.
     */
    public function index(Request $request)
    {
        //
        // return new PedidoCollection(Pedido::with('user')->with('productos')->where('estado',0)->get());

        // $clientes = Cliente::all();
        // return new ClienteCollection(Cliente::with('tipoDocumentos')->get());

        // $clientes = Cliente::with('tipoDocumentos')->get();

        // return ClienteResouce::collection($clientes);

          $query = Cliente::with("tipoDocumentos")->conPreferencias();

        if ($request->has('numDoc')) {
            $query->where('numDoc', $request->input('numDoc'));
        }

        if ($request->has('rznSocial')) {
            $query->where('rznSocial', 'like', '%' . $request->input('rznSocial') . '%');
        }

        if ($request->has('fav')) {
            $query->filtrarFavorito($request->input('fav'));
        }

        return ClienteResouce::collection($query->get());
    }

    /**
     * Buscar clientes
     *
     * Mismos filtros que el listado. El campo `fav` de la respuesta es el
     * favorito DEL USUARIO autenticado, no un valor compartido. Se filtra con
     * `?fav=1` (solo favoritos) o `?fav=0` (el resto).
     *
     * `nombreCorto` también es el del usuario: el que él le puso o, si no
     * puso ninguno, el del catálogo.
     */
    public function buscar(Request $request){

        $query = Cliente::with("tipoDocumentos")->conPreferencias();

        if ($request->has('numDoc')) {
            $query->where('numDoc', $request->input('numDoc'));
        }

        if ($request->has('rznSocial')) {
            $query->where('rznSocial', 'like', '%' . $request->input('rznSocial') . '%');
        }

        if ($request->has('fav')) {
            $query->filtrarFavorito($request->input('fav'));
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
     * Registrar cliente
     *
     * Si se envía `fav`, el registro queda marcado como favorito solo para
     * el usuario que lo crea.
     */
    public function store(ClienteRequest $request)
    {

        $request->validated();

        $persona = new Cliente();

        $persona->numDoc = $request->numDoc;
        $persona->rznSocial = $request->rznSocial;
        $persona->isCompany = $request->isCompany;
        $persona->email = $request->email;
        $persona->telephone = $request->telephone;
        $persona->nombreCorto = $request->nombreCorto;

        $persona->id_tipodocumento = TipoDocumento::where('tipoDoc',$request->tipoDoc)->value('id');

        $persona->save();

        // El favorito es del usuario que lo crea, no del catálogo completo
        $persona->aplicarFavorito($request->fav);

        $id = $persona->id;


        return [
            'message' => "Persona con id $id Insertado con exito",
            'persona' => $request->all()
        ];
    }

    /**
     * Ver cliente por id
     *
     * No implementado: actualmente devuelve una respuesta vacía.
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
     * Actualizar cliente
     *
     * `fav` y `nombreCorto` se guardan solo para el usuario autenticado (su
     * favorito y su nombre corto propio); el resto de campos son compartidos.
     * El nombre corto del catálogo no cambia: se fija al crear el registro.
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
        $cliente->aplicarFavorito($request->fav);
        if ($request->has('nombreCorto')) {
            $cliente->aplicarNombreCorto($request->input('nombreCorto'));
        }
        return [
            'cliente' => $cliente
        ];
    }

    /**
     * Eliminar cliente
     *
     * No implementado: actualmente devuelve una respuesta vacía.
     */
    public function destroy($id)
    {
        //
    }
}
