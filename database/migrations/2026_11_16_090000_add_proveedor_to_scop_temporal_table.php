<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Proveedor del pedido SCOP (lo envía la app que carga scop_temporal).
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('scop_temporal', function (Blueprint $table) {
            $table->string('proveedor', 400)->nullable()->after('factura');
        });
    }

    public function down()
    {
        Schema::table('scop_temporal', function (Blueprint $table) {
            $table->dropColumn('proveedor');
        });
    }
};
