<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Datos que devuelve la API de facturación al emitir una guía.
 *
 *   - fe_id:        id del documento en la API (data.id). Clave para consultar,
 *                   descargar y para reconocer el webhook.
 *   - fe_estado:    estado en la API (pendingTicket, accepted, observed,
 *                   rejected, error...). `estado` sigue siendo el local (P/F/B).
 *   - fe_qr_url:    enlace de SUNAT que va en el QR (data.sunat.urlQr).
 *   - fe_pdf_sunat: la API ya tiene el PDF oficial de SUNAT.
 *   - fe_intentos / fe_enviado_en: informativos.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('estado_electronico', function (Blueprint $table) {
            $table->string('fe_id', 40)->nullable()->unique()->after('ticket');
            $table->string('fe_estado', 20)->nullable()->after('fe_id');
            $table->text('fe_qr_url')->nullable()->after('fe_estado');
            $table->boolean('fe_pdf_sunat')->default(false)->after('fe_qr_url');
            $table->unsignedInteger('fe_intentos')->default(0)->after('fe_pdf_sunat');
            $table->dateTime('fe_enviado_en')->nullable()->after('fe_intentos');
        });
    }

    public function down()
    {
        Schema::table('estado_electronico', function (Blueprint $table) {
            $table->dropUnique(['fe_id']);
            $table->dropColumn(['fe_id', 'fe_estado', 'fe_qr_url', 'fe_pdf_sunat', 'fe_intentos', 'fe_enviado_en']);
        });
    }
};
