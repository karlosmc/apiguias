<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductoCollection;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return new ProductoCollection(Producto::all());
    }

    public function buscar(Request $request)
    {
        $query = Producto::query();

        if ($request->has('codigo')) {
            $query->where('codigo', $request->input('codigo'));
        }

        if ($request->has('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->input('descripcion') . '%');
        }
        if ($request->has('fav')) {
            $query->where('fav', $request->input('fav'));
        }

        return new ProductoCollection($query->get());
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

        $producto = new Producto;

        $producto->id_user = Auth::user()->id;
        $producto->codigo = $request->codigo;
        $producto->codProdSunat = $request->codProdSunat;
        $producto->descripcion = $request->descripcion;
        $producto->unidad = $request->unidad;
        $producto->fav = $request->fav;
        $producto->nombreCorto = $request->nombreCorto;
        $producto->save();

        $id = $producto->id;

        return [
            'message' => "Producto con id $id Insertado con exito",
            'producto' => $producto
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
    public function update(Request $request, Producto $producto)
    {
        //

        $data = $request->all();
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                $data[$key] = '';
            }
        }

        $producto->update($data);
        return [
            'producto' => $data
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
