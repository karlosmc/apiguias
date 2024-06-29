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
        Schema::create('estado_electronico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_despatch')->references('id')->on('despatches')->onDelete('cascade');
            $table->string('serie',10);
            $table->string('numero',20);
            $table->date('fecha');
            $table->string('estado',2)->default('V');
            $table->string('estadoSunat',10);
            $table->text('descripcion');
            $table->string('rutaXml');
            $table->string('rutaPdf');
            $table->string('rutaCdr');
            $table->text('cdrbase64');
            $table->string('hash',200)->nullable();
            $table->text('hashQr',500)->nullable();
            $table->text('token');
            $table->string('ticket')->nullable();
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
        Schema::dropIfExists('estado_electronico');
    }
};
