<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Usuarios que pueden entrar a la app Android (POST /api/movil/login) y pedir
 * credenciales PVO. Lo activa un admin; por defecto nadie tiene acceso.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('accesoMovil')->default(false)->after('aprobado');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('accesoMovil');
        });
    }
};
