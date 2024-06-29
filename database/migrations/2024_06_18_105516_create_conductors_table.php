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
        Schema::create('conductores', function (Blueprint $table) {
            $table->id();
            $table->string('nroDoc',20);
            $table->string('nombres',125);
            $table->string('apellidos',125);
            $table->string('licencia',20);
            $table->string('nombreCorto',50);
            $table->boolean('isCompany')->default(true);
            $table->boolean('fav')->default(false);
            $table->foreignId('id_tipodocumento')->references('id')->on('tipo_documentos')->onDelete('cascade');
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
        Schema::dropIfExists('conductores');
    }
};
