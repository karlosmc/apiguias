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
        Schema::create('almacen_fafio', function (Blueprint $table) {
            $table->id();
            $table->string('id_almacen_fafio');
            $table->foreignId('id_punto_ubicacion')->nullable()->references('id')->on('puntoubicacion')->onDelete('set null');
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
        Schema::dropIfExists('almacen_fafio');
    }
};
