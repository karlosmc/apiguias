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
        Schema::table('transportistas', function (Blueprint $table) {
            //
            $table->string('nroMtc',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transportistas', function (Blueprint $table) {
            //
            $table->dropColumn('nroMtc'); // Eliminar la columna id_shipment
        });
    }
};
