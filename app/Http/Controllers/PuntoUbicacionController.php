<?php

namespace App\Http\Controllers;

use App\Http\Resources\PuntoUbicacionCollection;
use App\Http\Resources\PuntoubicacionResouce;
use App\Models\Puntoubicacion;
use Illuminate\Http\Request;

class PuntoUbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return new PuntoUbicacionCollection(Puntoubicacion::all());

        $puntoubicaciones = Puntoubicacion::with('ubigeoRelation')->get();

        // Devuelve la respuesta con los datos
        // return response()->json($puntoubicaciones);

        return PuntoubicacionResouce::collection($puntoubicaciones);

    }

    public function buscar(Request $request)
    {
        $query = Puntoubicacion::with('ubigeoRelation');

        if ($request->has('ubigeo')) {
            $query->where('ubigeo', $request->input('ubigeo'));
        }

        if ($request->has('direccion')) {
            $query->where('direccion', 'like', '%' . $request->input('direccion') . '%');
        }

        
        if ($request->has('nombreCorto')) {
            $query->where('nombreCorto', 'like', '%' . $request->input('nombreCorto') . '%');
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
            $query->where('fav', $request->input('fav'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $punto = new Puntoubicacion();

        $punto->ubigeo = $request->ubigeo;
        $punto->direccion = $request->direccion;
        $punto->codLocal = $request->codLocal;
        $punto->ruc = $request->ruc;
        $punto->fav = $request->fav;
        $punto->isCompany = $request->isCompany;
        $punto->nombreCorto = $request->nombreCorto;
        $punto->save();

        $id = $punto->id;

        return [
            'message' => "Punto de ubicación con id $id Insertado con exito",
            'punto' => $punto
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
        return [
            'punto' => $data
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
