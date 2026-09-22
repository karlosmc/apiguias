<?php

namespace App\Http\Controllers;

use App\Http\Resources\PuntoUbicacionCollection;
use App\Http\Resources\PuntoubicacionResouce;
use App\Models\Puntoubicacion;
use Illuminate\Http\Request;

class PuntoUbicacionController extends Controller
{
    /**
     * Listar puntos de ubicación
     *
     * Acepta filtros por ubigeo, dirección, RUC o razón social.
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
        // return new PuntoUbicacionCollection(Puntoubicacion::all());

        // $puntoubicaciones = Puntoubicacion::with('ubigeoRelation')->get();

        // // Devuelve la respuesta con los datos
        // // return response()->json($puntoubicaciones);

        // return PuntoubicacionResouce::collection($puntoubicaciones);

         $query = Puntoubicacion::with('ubigeoRelation')->conPreferencias();

        if ($request->has('ubigeo')) {
            $query->where('ubigeo', $request->input('ubigeo'));
        }

        if ($request->has('direccion')) {
            $query->where('direccion', 'like', '%' . $request->input('direccion') . '%');
        }


        if ($request->has('nombreCorto')) {
            $query->filtrarNombreCorto($request->input('nombreCorto'));
        }

        if ($request->has('rznSocial')) {
            $query->where('rznSocial', 'like', '%' . $request->input('rznSocial') . '%');
        }
        if ($request->has('fullubigeo')) {
            $query->whereHas('ubigeoRelation', function ($q) use ($request) {
                $q->where('fullubigeo', 'like', '%' . $request->input('fullubigeo') . '%');
            });
        }

        if ($request->has('ruc')) {
            $query->where('ruc', $request->input('ruc'));
        }

        if ($request->has('fav')) {
            $query->filtrarFavorito($request->input('fav'));
        }

        if ($request->has('isCompany')) {
            $query->where('isCompany', $request->input('isCompany'));
        }

        return PuntoubicacionResouce::collection($query->get());

    }

    /**
     * Buscar puntos de ubicación
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
        $query = Puntoubicacion::with('ubigeoRelation')->conPreferencias();

        if ($request->has('ubigeo')) {
            $query->where('ubigeo', $request->input('ubigeo'));
        }

        if ($request->has('direccion')) {
            $query->where('direccion', 'like', '%' . $request->input('direccion') . '%');
        }


        if ($request->has('nombreCorto')) {
            $query->filtrarNombreCorto($request->input('nombreCorto'));
        }

        if ($request->has('rznSocial')) {
            $query->where('rznSocial', 'like', '%' . $request->input('rznSocial') . '%');
        }
        if ($request->has('fullubigeo')) {
            $query->whereHas('ubigeoRelation', function ($q) use ($request) {
                $q->where('fullubigeo', 'like', '%' . $request->input('fullubigeo') . '%');
            });
        }

        if ($request->has('ruc')) {
            $query->where('ruc', $request->input('ruc'));
        }

        if ($request->has('fav')) {
            $query->filtrarFavorito($request->input('fav'));
        }

        if ($request->has('isCompany')) {
            $query->where('isCompany', $request->input('isCompany'));
        }

        return PuntoubicacionResouce::collection($query->get());
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
     * Registrar punto de ubicación
     *
     * Si se envía `fav`, el registro queda marcado como favorito solo para
     * el usuario que lo crea.
     */
    public function store(Request $request)
    {
        //

        $punto = new Puntoubicacion();

        $punto->ubigeo = $request->ubigeo;
        $punto->direccion = $request->direccion;
        $punto->codLocal = $request->codLocal;
        $punto->rznSocial = $request->rznSocial;
        $punto->ruc = $request->ruc;
        $punto->isCompany = $request->isCompany;
        $punto->nombreCorto = $request->nombreCorto;
        $punto->save();

        // El favorito es del usuario que lo crea, no del catálogo completo
        $punto->aplicarFavorito($request->fav);

        $id = $punto->id;

        return [
            'message' => "Punto de ubicación con id $id Insertado con exito",
            'punto' => $punto
        ];
    }

    /**
     * Ver punto de ubicación por id
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
     * Actualizar punto de ubicación
     *
     * `fav` y `nombreCorto` se guardan solo para el usuario autenticado (su
     * favorito y su nombre corto propio); el resto de campos son compartidos.
     * El nombre corto del catálogo no cambia: se fija al crear el registro.
     */
    public function update(Request $request,Puntoubicacion $punto)
    {
        //
        $data = $request->all();
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                $data[$key] = '';
            }
        }

        $punto->update($data);
        $punto->aplicarFavorito($request->fav);
        if ($request->has('nombreCorto')) {
            $punto->aplicarNombreCorto($request->input('nombreCorto'));
        }

        return [
            'punto' => $data
        ];
    }

    /**
     * Eliminar punto de ubicación
     *
     * No implementado: actualmente devuelve una respuesta vacía.
     */
    public function destroy($id)
    {
        //
    }
}
