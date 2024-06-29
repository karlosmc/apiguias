<?php

namespace App\Http\Controllers;

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
}
