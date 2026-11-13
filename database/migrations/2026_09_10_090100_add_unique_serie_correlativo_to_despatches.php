<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Índice único serie + correlativo.
 *
 * Es la única garantía real contra guías duplicadas: la validación de
 * DespatchRequest corre antes de la transacción y dos peticiones simultáneas
 * la pasan las dos.
 *
 * Si la tabla todavía tiene duplicados la migración se detiene con un mensaje
 * en vez de dejar un error críptico de MySQL. Límpialos antes con:
 *
 *   php artisan despatches:duplicados            (reporte)
 *   php artisan despatches:duplicados --eliminar (borra las sobrantes)
 *
 * Los grupos que el comando marca como REVISAR (dos copias ya enviadas a
 * SUNAT) hay que resolverlos a mano antes de que esta migración pase.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $duplicados = DB::table('despatches')
        //     ->select('serie', 'correlativo', DB::raw('count(*) as total'))
        //     ->groupBy('serie', 'correlativo')
        //     ->havingRaw('count(*) > 1')
        //     ->get();

        // if ($duplicados->isNotEmpty()) {
        //     $ejemplos = $duplicados->take(5)
        //         ->map(fn ($d) => "{$d->serie}-{$d->correlativo} (x{$d->total})")
        //         ->implode(', ');

        //     throw new RuntimeException(
        //         'No se puede crear el índice único: hay ' . $duplicados->count() .
        //         ' serie-correlativo repetidos, por ejemplo ' . $ejemplos . '. ' .
        //         'Ejecuta primero: php artisan despatches:duplicados --eliminar'
        //     );
        // }

        // Schema::table('despatches', function (Blueprint $table) {
        //     $table->unique(['serie', 'correlativo'], 'unique_serie_correlativo');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('despatches', function (Blueprint $table) {
        //     $table->dropUnique('unique_serie_correlativo');
        // });
    }
};
