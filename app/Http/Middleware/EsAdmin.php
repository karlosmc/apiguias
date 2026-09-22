<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Deja pasar solo a usuarios con perfil admin. Va después de auth:sanctum.
 *
 * Uso en rutas: ->middleware('admin')
 */
class EsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (optional($request->user())->perfil !== 'admin') {
            return response()->json([
                'error' => 'Solo un usuario con perfil admin puede hacer esto',
                'exito' => false,
            ], 403);
        }

        return $next($request);
    }
}
