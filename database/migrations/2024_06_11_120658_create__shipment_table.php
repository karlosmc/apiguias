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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->boolean('indTransbordo')->default(false);
            $table->string('sustentoPeso',250)->default('');
            $table->decimal('pesoItems',12,3);
            $table->decimal('pesoTotal',12,3);
            $table->string('undPesoTotal',5)->default('KGM');
            $table->decimal('numBultos',6,0);
            $table->date('fecTraslado');
            $table->string('estado',1)->default('V');
            $table->foreignId('id_puerto')->nullable()->references('id')->on('puerto')->onDelete('cascade');
            $table->foreignId('id_aeropuerto')->nullable()->references('id')->on('puerto')->onDelete('cascade');
            $table->foreignId('id_mottraslado')->references('id')->on('motivo_traslado')->onDelete('cascade');
            $table->foreignId('id_modtraslado')->references('id')->on('modalidad_traslado')->onDelete('cascade');
            $table->foreignId('id_partida')->references('id')->on('puntoubicacion')->onDelete('cascade');
            $table->foreignId('id_llegada')->references('id')->on('puntoubicacion')->onDelete('cascade');
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
        Schema::dropIfExists('shipments');
    }
};
