<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function register(RegistroRequest $request){

        $data = $request->validated();

        $user = User::create([
            'name' =>$data['name'],
            'email' =>$data['email'],
            'documento' =>$data['documento'],
            'password' =>bcrypt($data['password']),
            'id_empresa' =>$data['id_empresa']
        ]);
        return [
            'token' =>$user->createToken('token')->plainTextToken,
            'user' =>$user
        ];
    }

    public function login(LoginRequest $request){

       
        $data = $request->validated();

        if(!Auth::attempt($data)){
            return response([
                'errors' => ['El documento o el password son incorrectos']
            ],422);
        }

        $user = Auth::user();

        if(!$user->aprobado){
            return [
                'token' =>'',
                'user' =>$user,
                'error'=>'Tu cuenta aún no ha sido aprobada, comúnicate con el administrador'
            ];
        }

        return [
            'token' =>$user->createToken('token')->plainTextToken,
            'user' =>$user
        ];
    }

    public function logout(Request $request){
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return [
            'user'=>null
        ];
    }
}
