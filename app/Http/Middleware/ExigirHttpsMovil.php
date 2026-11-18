<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * La app móvil manda la contraseña del usuario y recibe un token: fuera de
 * pruebas solo por HTTPS. Se desactiva con MOVIL_EXIGIR_HTTPS=false.
 */
class ExigirHttpsMovil
{
    public function handle(Request $request, Closure $next)
    {
        if (config('services.movil.exigir_https') && ! $request->secure()) {
            return response()->json([
                'exito' => false,
                'error' => 'La app móvil solo funciona por HTTPS',
            ], 403);
        }

        return $next($request);
    }
}
