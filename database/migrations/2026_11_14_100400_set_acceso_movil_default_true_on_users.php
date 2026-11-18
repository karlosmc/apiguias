<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Acceso a la app móvil abierto por defecto: todo usuario (aprobado) puede
 * entrar. El admin solo lo QUITA a quien corresponda, con
 * PATCH /api/admin/usuarios/{id}/acceso-movil {"accesoMovil": false}.
 *
 * Se activa a los usuarios que ya existen y queda como valor por defecto
 * para los nuevos.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('accesoMovil')->default(true)->change();
        });

        DB::table('users')->update(['accesoMovil' => true]);
    }

    public function down()
    {
        // Solo vuelve el valor por defecto; no se sabe a quién se le quitó antes
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('accesoMovil')->default(false)->change();
        });
    }
};
