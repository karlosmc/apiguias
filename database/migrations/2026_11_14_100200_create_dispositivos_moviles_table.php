<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Celular con el que un usuario inició sesión en la app Android. Guarda su
 * llave pública (Android Keystore): las credenciales PVO se le entregan
 * cifradas con ella, así que solo ese celular puede leerlas.
 *
 * `id_token` es el token Sanctum de esa sesión (sin FK: al revocar se borra el
 * token y la fila queda como historial, con `revocadoEn`).
 */
return new class extends Migration
{
    public function up()
    {
        Schema::create('dispositivos_moviles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('nombre', 100);
            $table->text('llavePublica');
            $table->unsignedBigInteger('id_token')->nullable()->index();
            $table->dateTime('ultimoAcceso')->nullable();
            $table->dateTime('revocadoEn')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dispositivos_moviles');
    }
};
