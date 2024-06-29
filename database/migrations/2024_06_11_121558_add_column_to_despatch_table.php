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
        Schema::table('despatches', function (Blueprint $table) {
            $table->unsignedBigInteger('id_shipment');
            $table->foreign('id_shipment')->references('id')->on('shipments')->onDelete('cascade');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('despatches', function (Blueprint $table) {
            //
            // $table->dropForeign('despatches_id_shipment_foreign');
            // $table->dropColumn('id_shipment');
            $table->dropForeign(['id_shipment']); // Eliminar la clave foránea
            $table->dropColumn('id_shipment'); // Eliminar la columna id_shipment


        });
    }
};
