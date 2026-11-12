<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Favoritos por usuario
    |--------------------------------------------------------------------------
    |
    | Decide dónde se guardan `fav` y `nombreCorto` de los catálogos
    | (productos, clientes, puntos, conductores, transportistas, vehículos).
    |
    | false (por defecto): como se hacía antes. Se guardan en las columnas
    |        `fav` y `nombreCorto` de cada tabla y son compartidos por todos
    |        los usuarios. La tabla `favoritos` no se usa ni se toca.
    |
    | true:  cada usuario tiene sus propios favoritos y nombres cortos en la
    |        tabla `favoritos` (incluye ver/clonar favoritos de otro usuario).
    |
    | Las rutas y respuestas del API son las mismas en ambos modos.
    |
    */

    'por_usuario' => env('FAVORITOS_POR_USUARIO', false),

];
