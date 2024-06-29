<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            //
            DB::statement('ALTER TABLE clientes MODIFY email VARCHAR(255) NULL');
            DB::statement('ALTER TABLE clientes MODIFY telephone VARCHAR(255) NULL');
            DB::statement('ALTER TABLE clientes MODIFY nombreCorto VARCHAR(30) NULL');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            //
            DB::statement('ALTER TABLE clientes MODIFY email VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE clientes MODIFY telephone VARCHAR(255) NOT NULL');
            DB::statement('ALTER TABLE clientes MODIFY nombreCorto VARCHAR(30) NOT NULL');
        });
    }
};
