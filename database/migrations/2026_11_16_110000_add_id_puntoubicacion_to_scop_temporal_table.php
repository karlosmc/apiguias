<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Establecimiento (punto de ubicación) del SCOP: la app lo envía como
 * `idEstablecimiento` (el `id` de GET /api/movil/maestros). En líquidos la
 * guía filtra por placa Y por su punto de llegada (antes, la "sucursal" del
 * portal era ese mismo id). En GLP va vacío: ahí la sucursal es la placa.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('scop_temporal', function (Blueprint $table) {
            $table->foreignId('id_puntoubicacion')->nullable()->after('placa')
                ->references('id')->on('puntoubicacion')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('scop_temporal', function (Blueprint $table) {
            $table->dropForeign(['id_puntoubicacion']);
            $table->dropColumn('id_puntoubicacion');
        });
    }
};
