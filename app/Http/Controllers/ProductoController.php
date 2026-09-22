<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductoCollection;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    /**
     * Listar productos
     *
     * Acepta filtros por código, descripción o nombre corto.
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

        // return new ProductoCollection(Producto::all());

        $query = Producto::query()->conPreferencias();

        if ($request->has('codigo')) {
            $query->where('codigo', $request->input('codigo'));
        }

        if ($request->has('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->input('descripcion') . '%');
        }

        if ($request->has('nombreCorto')) {
            $query->filtrarNombreCorto($request->input('nombreCorto'));
        }

        if ($request->has('fav')) {
            $query->filtrarFavorito($request->input('fav'));
        }

        return new ProductoCollection($query->get());
    }

    /**
     * Buscar productos
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
        $query = Producto::query()->conPreferencias();

        if ($request->has('codigo')) {
            $query->where('codigo', $request->input('codigo'));
        }

        if ($request->has('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->input('descripcion') . '%');
        }

        if ($request->has('nombreCorto')) {
            $query->filtrarNombreCorto($request->input('nombreCorto'));
        }

        if ($request->has('fav')) {
            $query->filtrarFavorito($request->input('fav'));
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
     * Registrar producto
     *
     * Si se envía `fav`, el registro queda marcado como favorito solo para
     * el usuario que lo crea.
     */
    public function store(Request $request)
    {
        //

        try {
            //code...


        $producto = new Producto;

        $producto->id_user = Auth::user()->id;
        $producto->codigo = $request->codigo;
        $producto->codProdSunat = $request->codProdSunat;
        $producto->descripcion = $request->descripcion;
        $producto->unidad = $request->unidad;
        $producto->nombreCorto = $request->nombreCorto;
        $producto->save();

        // El favorito es del usuario que lo crea, no del catálogo completo
        $producto->aplicarFavorito($request->fav);

        $id = $producto->id;

        return [
            'message' => "Producto con id $id Insertado con exito",
            'producto' => $producto
        ];

        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'message' => 'Error al insertar el producto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Ver producto por id
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
     * Actualizar producto
     *
     * `fav` y `nombreCorto` se guardan solo para el usuario autenticado (su
     * favorito y su nombre corto propio); el resto de campos son compartidos.
     * El nombre corto del catálogo no cambia: se fija al crear el registro.
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
        $producto->aplicarFavorito($request->fav);
        if ($request->has('nombreCorto')) {
            $producto->aplicarNombreCorto($request->input('nombreCorto'));
        }

        return [
            'producto' => $data
        ];
    }

    /**
     * Eliminar producto
     *
     * No implementado: actualmente devuelve una respuesta vacía.
     */
    public function destroy($id)
    {
        //
    }
}
