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
        Schema::create('puntoubicacion', function (Blueprint $table) {
            $table->id();
            $table->string('ubigeo',10);
            $table->string('direccion',500);
            $table->string('codLocal',10)->default('0000');
            $table->string('ruc',20);
            $table->boolean('isCompany')->default(false);
            $table->boolean('fav')->default(false);
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
        Schema::dropIfExists('puntoubicacion');
    }
};
