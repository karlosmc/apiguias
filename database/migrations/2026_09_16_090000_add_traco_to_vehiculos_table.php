<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Marca si el vehículo es traco. Los que ya existen quedan en true, que es el
 * valor por defecto para los nuevos.
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
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->boolean('traco')->default(true)->after('isCompany');
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
            $table->dropColumn('traco');
        });
    }
};
