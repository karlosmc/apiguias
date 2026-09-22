<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiculoRequest;
use App\Http\Resources\VehiculoCollection;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Listar vehículos
     *
     * Acepta filtros por placa o nombre corto.
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
        $query = Vehiculo::query()->conPreferencias();

        if ($request->has('placa')) {
            $query->where('placa', $request->input('placa'));
        }

        if ($request->has('nombreCorto')) {
            $query->filtrarNombreCorto($request->input('nombreCorto'));
        }

        if ($request->has('fav')) {
            $query->filtrarFavorito($request->input('fav'));
        }
        if ($request->has('isCompany')) {
            $query->where('isCompany', $request->input('isCompany'));
        }

        return new VehiculoCollection($query->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Buscar vehículos
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
        $query = Vehiculo::query()->conPreferencias();

        if ($request->has('placa')) {
            $query->where('placa', $request->input('placa'));
        }

        if ($request->has('nombreCorto')) {
            $query->filtrarNombreCorto($request->input('nombreCorto'));
        }

        if ($request->has('fav')) {
            $query->filtrarFavorito($request->input('fav'));
        }
        if ($request->has('isCompany')) {
            $query->where('isCompany', $request->input('isCompany'));
        }

        return new VehiculoCollection($query->get());
    }
    public function create()
    {
        //


    }

    /**
     * Registrar vehículo
     *
     * `tracto` es true salvo que se mande expresamente false, y `glp` es false
     * salvo que se mande true. Ambos aceptan 1/0, true/false y "true"/"false".
     *
     * Si se envía `fav`, el registro queda marcado como favorito solo para
     * el usuario que lo crea.
     */
    public function store(VehiculoRequest $request)
    {
        //

        $request->validated();

        $vehiculo = new Vehiculo();

        $vehiculo->placa = strtoupper($request->placa);
        $vehiculo->nroCirculacion = strtoupper($request->nroCirculacion);
        $vehiculo->nroAutorizacion = strtoupper($request->nroAutorizacion);
        $vehiculo->codEmisor = strtoupper($request->codEmisor);
        // Son NOT NULL con defecto: si no vienen se respeta el defecto en vez de
        // intentar guardar null y reventar.
        $vehiculo->isCompany = $this->booleano($request, 'isCompany', true);
        $vehiculo->tracto = $this->booleano($request, 'tracto', true);
        $vehiculo->glp = $this->booleano($request, 'glp', false);
        $vehiculo->nombreCorto = strtoupper($request->nombreCorto);

        $vehiculo->save();

        // El favorito es del usuario que lo crea, no del catálogo completo
        $vehiculo->aplicarFavorito($request->fav);

        $id = $vehiculo->id;

        return [
            'message' => "Vehiculo con id $id Insertado con exito",
            'vehiculo' => $vehiculo
        ];
    }

    /**
     * Ver vehículo por id
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
     * Actualizar vehículo
     *
     * `fav` y `nombreCorto` se guardan solo para el usuario autenticado (su
     * favorito y su nombre corto propio); el resto de campos son compartidos.
     * El nombre corto del catálogo no cambia: se fija al crear el registro.
     *
     * `tracto` y `glp` aceptan 1/0, true/false y "true"/"false". Si no se
     * envían, no cambian.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        // Reglas permisivas: no rechazan nada, solo sirven para que la
        // documentación OpenAPI muestre qué campos acepta el PUT.
        $request->validate([
            'placa' => ['sometimes', 'nullable'],
            'nroCirculacion' => ['sometimes', 'nullable'],
            'nroAutorizacion' => ['sometimes', 'nullable'],
            'codEmisor' => ['sometimes', 'nullable'],
            'isCompany' => ['sometimes', 'nullable'],
            'nombreCorto' => ['sometimes', 'nullable'],
            'fav' => ['sometimes', 'nullable'],
            'tracto' => ['sometimes', 'nullable'],
            'glp' => ['sometimes', 'nullable'],
        ]);

        $data = $request->all();
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                $data[$key] = '';
            }
        }

        // Sin esto, un "false" de texto llegaría tal cual a una columna tinyint
        foreach (['tracto', 'glp'] as $campo) {
            if ($request->filled($campo)) {
                $data[$campo] = filter_var($request->input($campo), FILTER_VALIDATE_BOOLEAN);
            } else {
                unset($data[$campo]);
            }
        }

        $vehiculo->update($data);
        $vehiculo->aplicarFavorito($request->fav);
        if ($request->has('nombreCorto')) {
            $vehiculo->aplicarNombreCorto($request->input('nombreCorto'));
        }

        return [
            'vehiculo' => $data
        ];
    }

    /**
     * Eliminar vehículo
     *
     * No implementado: actualmente devuelve una respuesta vacía.
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Lee un booleano del request aceptando 1/0, true/false y "true"/"false".
     * Si no viene, o viene vacío, devuelve el valor por defecto.
     */
    private function booleano(Request $request, string $campo, bool $defecto)
    {
        return $request->filled($campo)
            ? filter_var($request->input($campo), FILTER_VALIDATE_BOOLEAN)
            : $defecto;
    }
}
