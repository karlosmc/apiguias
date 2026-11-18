<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Usuario y contraseña del PVO de Osinergmin de cada establecimiento o placa
 * propia. Cada fila pertenece a UNO de los dos (id_puntoubicacion o
 * id_vehiculo); el controlador lo garantiza.
 *
 * `usuario` y `clave` se guardan cifrados con APP_KEY (cast `encrypted` en
 * CredencialPvo): un backup de la base sin el .env no las expone, y al
 * restaurar en otra instalación hay que usar la misma APP_KEY.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::create('credenciales_pvo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_puntoubicacion')->nullable()->unique()
                ->references('id')->on('puntoubicacion')->onDelete('cascade');
            $table->foreignId('id_vehiculo')->nullable()->unique()
                ->references('id')->on('vehiculos')->onDelete('cascade');
            $table->text('usuario');
            $table->text('clave');
            $table->boolean('activo')->default(true);
            $table->foreignId('id_user_actualizo')->nullable()
                ->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('credenciales_pvo');
    }
};
