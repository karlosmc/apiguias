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
        Schema::create('despatch_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_despatch')->references('id')->on('despatches')->onDelete('cascade');
            $table->foreignId('id_producto')->references('id')->on('productos')->onDelete('cascade');
            $table->string('codigo',100);
            $table->string('codProdSunat',100)->nullable();
            $table->string('descripcion',400);
            $table->string('unidad',50);
            $table->decimal('cantidad',10,2);
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
        Schema::dropIfExists('despatch_productos');
    }
};
