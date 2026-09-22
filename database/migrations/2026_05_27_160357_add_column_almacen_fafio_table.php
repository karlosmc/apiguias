<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('almacen_fafio', function (Blueprint $table) {
            //
            $table->string('nombre')->nullable()->after('id_punto_ubicacion');
            $table->string('entrada')->nullable()->after('nombre');
            $table->string('salida')->nullable()->after('entrada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('almacen_fafio', function (Blueprint $table) {
            //
            $table->dropColumn('nombre');
            $table->dropColumn('entrada');
            $table->dropColumn('salida');
        });
    }
};
