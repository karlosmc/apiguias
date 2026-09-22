<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransportistaRequest;
use App\Http\Resources\TransportistaCollection;
use App\Http\Resources\TransportistaResource;
use App\Models\TipoDocumento;
use App\Models\Transportista;
use Illuminate\Http\Request;

class TransportistaController extends Controller
{
    /**
     * Listar transportistas
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

        $query = Transportista::with("tipoDocumentos")->conPreferencias();

        if ($request->has('numDoc')) {
            $query->where('numDoc', $request->input('numDoc'));
        }

        if ($request->has('rznSocial')) {
            $query->where('rznSocial', 'like', '%' . $request->input('rznSocial') . '%');
        }

        if ($request->has('fav')) {
            $query->filtrarFavorito($request->input('fav'));
        }

        return new TransportistaCollection($query->get());
    }

    /**
     * Buscar transportistas
     *
     * Mismos filtros que el listado. El campo `fav` de la respuesta es el
     * favorito DEL USUARIO autenticado, no un valor compartido. Se filtra con
     * `?fav=1` (solo favoritos) o `?fav=0` (el resto).
     *
     * `nombreCorto` también es el del usuario: el que él le puso o, si no
     * puso ninguno, el del catálogo.
     */
    public function buscar(Request $request)
    {

        $query = Transportista::with("tipoDocumentos")->conPreferencias();

        if ($request->has('numDoc')) {
            $query->where('numDoc', $request->input('numDoc'));
        }

        if ($request->has('rznSocial')) {
            $query->where('rznSocial', 'like', '%' . $request->input('rznSocial') . '%');
        }

        if ($request->has('fav')) {
            $query->filtrarFavorito($request->input('fav'));
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
     * Registrar transportista
     *
     * Si se envía `fav`, el registro queda marcado como favorito solo para
     * el usuario que lo crea.
     */
    public function store(TransportistaRequest $request)
    {
        $request->validated();



        $transportista = new Transportista();

        $transportista->numDoc = $request->numDoc;
        $transportista->rznSocial = $request->rznSocial;
        $transportista->nombreCorto = $request->nombreCorto;
        $transportista->id_tipodocumento = TipoDocumento::where('tipoDoc', $request->tipoDoc)->value('id');
        $transportista->nroMtc = $request->nroMtc;
        $transportista->save();

        // El favorito es del usuario que lo crea, no del catálogo completo
        $transportista->aplicarFavorito($request->fav);

        $id = $transportista->id;

        return [
            'message' => "transportista con id $id Insertado con exito",
            'transportista' => $request->all()
        ];
    }

    /**
     * Ver transportista por id
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
     * Actualizar transportista
     *
     * `fav` y `nombreCorto` se guardan solo para el usuario autenticado (su
     * favorito y su nombre corto propio); el resto de campos son compartidos.
     * El nombre corto del catálogo no cambia: se fija al crear el registro.
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

        $data["id_tipodocumento"] = TipoDocumento::where('tipoDoc', $request->tipoDoc)->value('id');
        $transportista->update($data);
        $transportista->refresh();
        $transportista->aplicarFavorito($request->fav);
        if ($request->has('nombreCorto')) {
            $transportista->aplicarNombreCorto($request->input('nombreCorto'));
        }
        return [
            'transportista' => $transportista
        ];
    }

    /**
     * Eliminar transportista
     *
     * No implementado: actualmente devuelve una respuesta vacía.
     */
    public function destroy($id)
    {
        //
    }
}
