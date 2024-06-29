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
        Schema::create('users_puntoemision', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('users_puntoemision');
    }
};
