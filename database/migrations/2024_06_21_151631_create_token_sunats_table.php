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
        Schema::create('token_sunat', function (Blueprint $table) {
            $table->id();
            $table->text('access_token');
            $table->string('token_type',20);
            $table->decimal('expires_in',10,0);
            $table->bigInteger('expiryTime');
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
        Schema::dropIfExists('token_sunat');
    }
};
