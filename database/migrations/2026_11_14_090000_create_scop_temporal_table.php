<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * SCOP temporales: los carga otra aplicación (POST /api/scop-temporal, sin
 * login) para que el front los elija por placa al armar la guía.
 *
 * `lote` agrupa todo lo que llegó en una misma carga: así se borra de una vez
 * (DELETE /api/scop-temporal/lotes/{lote}) cuando ya no se necesita.
 *
 * No es la tabla `scop` (números ya usados en una guía): aquí un número puede
 * repetirse, p. ej. un SCOP con varios productos o el mismo en dos lotes.
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
        Schema::create('scop_temporal', function (Blueprint $table) {
            $table->id();
            $table->string('lote', 64);
            $table->string('nroScop', 50);
            $table->string('factura', 30)->nullable();
            $table->dateTime('fechaPedido')->nullable();
            $table->dateTime('fechaVenta')->nullable();
            $table->dateTime('fechaDespacho')->nullable();
            $table->string('estadoPedido', 100)->nullable();
            $table->string('producto', 200)->nullable();
            // Normalizada: mayúsculas, sin espacios ni guiones (búsqueda por placa)
            $table->string('placa', 15);
            $table->decimal('volumen', 14, 4)->nullable();
            $table->string('unidadMedida', 10)->nullable();
            $table->timestamps();

            $table->index('lote', 'scop_temporal_lote');
            $table->index('placa', 'scop_temporal_placa');
            $table->index('nroScop', 'scop_temporal_nroscop');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scop_temporal');
    }
};
