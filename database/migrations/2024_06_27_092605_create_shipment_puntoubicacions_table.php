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
        Schema::create('shipment_puntoubicacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_shipment')->references('id')->on('shipments')->onDelete('cascade');
            $table->foreignId('id_puntoubicacion')->references('id')->on('puntoubicacion')->onDelete('cascade');
            $table->string('ubigeo',10);
            $table->string('direccion',500);
            $table->string('codLocal',10)->default('0000');
            $table->string('ruc',20);
            $table->string('tipo',1)->default('P');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_puntoubicacions');
    }
};
