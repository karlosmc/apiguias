<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Números de SCOP de una guía. Una guía puede tener varios o ninguno.
 *
 * `nroScop` es único en toda la tabla: es lo que garantiza que un número no se
 * use en dos guías a la vez. Al dar de baja una guía sus filas se borran, con
 * lo que esos números vuelven a quedar libres.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scop', function (Blueprint $table) {
            $table->id();
            $table->string('nroScop', 50)->unique('scop_nroscop_unico');
            $table->foreignId('id_despatch')->constrained('despatches')->onDelete('cascade');
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
        Schema::dropIfExists('scop');
    }
};
