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
        Schema::create('productos_fafio', function (Blueprint $table) {
            $table->id();
            $table->string('id_producto_fafio');
            $table->foreignId('id_producto')->nullable()->references('id')->on('productos')->onDelete('set null');
            $table->string('nombre');
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
        Schema::dropIfExists('productos_fafio');
    }
};
