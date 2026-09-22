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
        Schema::create('numeracion_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_numeracion')->references('id')->on('numeracion')->onDelete('cascade');
            $table->foreignId('id_primario')->references('id')->on('vehiculos')->onDelete('cascade');
            $table->foreignId('id_secundario')->nullable()->references('id')->on('vehiculos')->onDelete('cascade');
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
        Schema::dropIfExists('numeracion_vehiculos');
    }
};
