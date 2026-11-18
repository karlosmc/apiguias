<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Auditoría: cada vez que la app móvil recibe una credencial PVO queda quién,
 * cuál, desde qué celular, IP y cuándo.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::create('credenciales_pvo_accesos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_credencial')->references('id')->on('credenciales_pvo')->onDelete('cascade');
            $table->foreignId('id_user')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->foreignId('id_dispositivo')->nullable()->references('id')->on('dispositivos_moviles')->nullOnDelete();
            $table->string('ip', 45)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('credenciales_pvo_accesos');
    }
};
