<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * La tabla favoritos pasa a guardar todas las preferencias de un usuario sobre
 * un registro del catálogo, no solo si es favorito:
 *
 *   - fav:         si lo tiene marcado como favorito.
 *   - nombreCorto: el nombre corto que ese usuario le puso. null = usa el del
 *                  catálogo.
 *
 * Una fila puede existir sin ser favorito (solo tiene nombre propio), por eso
 * `fav` ya no se deduce de que la fila exista.
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
        Schema::table('favoritos', function (Blueprint $table) {
            // Todas las filas que ya existen se crearon como favoritos
            $table->boolean('fav')->default(true)->after('favoritable_id');
            $table->string('nombreCorto')->nullable()->after('fav');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Sin la columna fav, cualquier fila se leería como favorito
        DB::table('favoritos')->where('fav', false)->delete();

        Schema::table('favoritos', function (Blueprint $table) {
            $table->dropColumn(['fav', 'nombreCorto']);
        });
    }
};
