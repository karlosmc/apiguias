<?php

namespace App\Providers;

use App\Models\Cliente;
use App\Models\Conductor;
use App\Models\Producto;
use App\Models\Puntoubicacion;
use App\Models\Transportista;
use App\Models\Vehiculo;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Alias que se guardan en favoritos.favoritable_type. Son también los
     * valores que acepta el parámetro `tipo` del API de favoritos.
     */
    public const TIPOS_FAVORITOS = [
        'producto' => Producto::class,
        'cliente' => Cliente::class,
        'punto' => Puntoubicacion::class,
        'conductor' => Conductor::class,
        'transportista' => Transportista::class,
        'vehiculo' => Vehiculo::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap(self::TIPOS_FAVORITOS);

        $this->documentacionOpenApi();
    }

    /**
     * Título y autenticación de la documentación que genera Scramble en /docs/api.
     */
    private function documentacionOpenApi()
    {
        if (! class_exists(Scramble::class)) {
            return;
        }

        Scramble::extendOpenApi(function (OpenApi $openApi) {
            $openApi->info->title = 'API Guías de Remisión Electrónica';

            // Token de Sanctum que devuelve POST /api/login
            $openApi->secure(SecurityScheme::http('bearer'));
        });
    }
}
