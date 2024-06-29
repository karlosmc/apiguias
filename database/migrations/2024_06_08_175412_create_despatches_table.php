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
        Schema::create('despatches', function (Blueprint $table) {
            $table->id();
            $table->string('version',10)->default('2.0');
            $table->string('serie',10);
            $table->string('correlativo',10);
            $table->text('observacion')->nullable();
            $table->dateTime('fechaEmision');
            $table->foreignId('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreignId('id_tercero')->nullable()->references('id')->on('clientes')->onDelete('cascade');
            $table->foreignId('id_comprador')->nullable()->references('id')->on('clientes')->onDelete('cascade');
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
        Schema::dropIfExists('despatches');
    }
};
