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
        Schema::create('shipment_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_shipment')->references('id')->on('shipments')->onDelete('cascade');
            $table->foreignId('id_vehiculo')->references('id')->on('vehiculos')->onDelete('cascade');
            $table->string('tipo',50)->default('Principal');
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
        Schema::dropIfExists('shipment_vehiculo');
    }
};
