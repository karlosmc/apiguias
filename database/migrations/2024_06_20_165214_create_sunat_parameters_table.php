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
        Schema::create('sunat_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('client_id',200);
            $table->string('client_secret',200);
            $table->string('username',200);
            $table->string('password',200);
            $table->string('scope',100);
            $table->string('grant_type',100);
            $table->string('env',50)->default('dev');
            $table->string('endpointurl',250)->default('dev');
            $table->text('certificado');
            $table->string('clavecertificado');
            $table->string('urlsend');
            $table->string('urlconsult');
            $table->foreignId('id_empresa')->references('id')->on('empresa')->onDelete('cascade');
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
        Schema::dropIfExists('sunat_parameters');
    }
};
