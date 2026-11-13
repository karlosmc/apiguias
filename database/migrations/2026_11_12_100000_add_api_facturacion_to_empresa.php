<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Conexión con la API de facturación guardada en la empresa (como en el ERP),
 * en vez de solo en el .env. Se edita con PUT /api/empresa/facturacion.
 *
 * El token y el secreto se guardan cifrados con el APP_KEY de guiasapi: si el
 * APP_KEY cambia hay que volver a cargarlos. Si estas columnas están vacías se
 * usan FE_API_URL / FE_API_TOKEN / FE_WEBHOOK_SECRET del .env.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('empresa', function (Blueprint $table) {
            $table->string('fe_api_url', 300)->nullable();
            $table->text('fe_api_token')->nullable();
            $table->text('fe_webhook_secret')->nullable();
        });
    }

    public function down()
    {
        Schema::table('empresa', function (Blueprint $table) {
            $table->dropColumn(['fe_api_url', 'fe_api_token', 'fe_webhook_secret']);
        });
    }
};
