<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UsersPuntoemision;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function getpuntos($id){
        
        $usuario = User::findOrFail($id);
        $puntos = $usuario->puntoemision;
        return response()->json($puntos);

    }

    public function buscar(Request $request){

        $query = User::query();

        if ($request->has('documento')) {
            $query->where('documento', $request->input('documento'));
        }

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        return UserResource::collection($query->get());

    }
}
