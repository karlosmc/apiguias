<?php

use Illuminate\Database\Migrations\Migration;

/**
 * Aquí estaba el intento de índice único serie + correlativo.
 *
 * Se movió a 2026_09_10_090100_add_unique_serie_correlativo_to_despatches para
 * que quede DESPUÉS de la tabla de favoritos: mientras la tabla despatches
 * tenga duplicados esa migración falla a propósito, y así no bloquea al resto.
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
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
