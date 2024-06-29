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
        Schema::create('puntos_emision', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',10);
            $table->string('nombre',100);
            $table->string('codLocal',4)->nullable();
            $table->string('direccion',250)->nullable();
            $table->string('ruc',11);
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
        Schema::dropIfExists('puntos_emision');
    }
};
