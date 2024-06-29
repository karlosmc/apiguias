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
        Schema::create('numeracion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',200);
            $table->string('serie',4);
            $table->float('numeroActual')->default(0);
            $table->foreignId('id_puntoemision')->references('id')->on('puntos_emision')->onDelete('cascade');
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
        Schema::dropIfExists('numeracion');
    }
};
