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
     * Listar conductores
     *
     * Acepta filtros por documento, nombres, apellidos o licencia.
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


        // $conductores = Conductor::with('tipoDocumentos')->get();

        // return ConductorResource::collection($conductores);

           $query = Conductor::with("tipoDocumentos")->conPreferencias();

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
            $query->filtrarFavorito($request->input('fav'));
        }

        return ConductorResource::collection($query->get());
    }


    /**
     * Buscar conductores
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

        $query = Conductor::with("tipoDocumentos")->conPreferencias();

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
            $query->filtrarFavorito($request->input('fav'));
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
     * Registrar conductor
     *
     * Si se envía `fav`, el registro queda marcado como favorito solo para
     * el usuario que lo crea.
     */
    public function store(ConductorRequest $request)
    {
        //

        $request->validated();



        $conductor = new Conductor();

        $conductor->nroDoc = $request->nroDoc;
        $conductor->isCompany = $request->isCompany;
        $conductor->nombres = $request->nombres;
        $conductor->apellidos = $request->apellidos;
        $conductor->nombreCorto = $request->nombreCorto;
        $conductor->licencia = $request->licencia;

        $conductor->id_tipodocumento = TipoDocumento::where('tipoDoc', $request->tipoDoc)->value('id');

        $conductor->save();

        // El favorito es del usuario que lo crea, no del catálogo completo
        $conductor->aplicarFavorito($request->fav);

        $id = $conductor->id;


        return [
            'message' => "Conductor con id $id Insertado con exito",
            'conductor' => $request->all()
        ];
    }

    /**
     * Ver conductor por id
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
     * Actualizar conductor
     *
     * `fav` y `nombreCorto` se guardan solo para el usuario autenticado (su
     * favorito y su nombre corto propio); el resto de campos son compartidos.
     * El nombre corto del catálogo no cambia: se fija al crear el registro.
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
        $conductor->aplicarFavorito($request->fav);
        if ($request->has('nombreCorto')) {
            $conductor->aplicarNombreCorto($request->input('nombreCorto'));
        }
        return [
            'conductor' => $conductor,
        ];
    }

    /**
     * Eliminar conductor
     *
     * No implementado: actualmente devuelve una respuesta vacía.
     */
    public function destroy($id)
    {
        //
    }
}
