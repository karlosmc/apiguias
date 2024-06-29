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
        Schema::create('shipment_indicadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_shipment')->references('id')->on('shipments')->onDelete('cascade');
            $table->foreignId('id_indicadores')->references('id')->on('indicadores')->onDelete('cascade');
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
        Schema::dropIfExists('shipment_indicadores');
    }
};
