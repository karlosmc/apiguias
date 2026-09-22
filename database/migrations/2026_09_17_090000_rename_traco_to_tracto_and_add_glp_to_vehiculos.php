<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Corrige el nombre `traco` -> `tracto` y agrega `glp`.
 *
 * La migración 2026_09_16_090000 que creó `traco` ya se ejecutó, por eso el
 * cambio va en una migración nueva en lugar de editar aquella.
 *
 *   - tracto: si el vehículo es tracto. Conserva los valores y el defecto true.
 *   - glp:    si el vehículo es de GLP. Defecto false.
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
        // RENAME COLUMN (MySQL 8) conserva tipo, NOT NULL y el defecto
        DB::statement('ALTER TABLE vehiculos RENAME COLUMN traco TO tracto');

        Schema::table('vehiculos', function (Blueprint $table) {
            $table->boolean('glp')->default(false)->after('tracto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->dropColumn('glp');
        });

        DB::statement('ALTER TABLE vehiculos RENAME COLUMN tracto TO traco');
    }
};
