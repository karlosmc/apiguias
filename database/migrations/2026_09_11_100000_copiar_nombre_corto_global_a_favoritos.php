<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Copia el nombreCorto del catálogo a cada fila de favoritos que no tenga uno.
 *
 * A partir de aquí favoritos.nombreCorto guarda siempre el nombre que ve cada
 * usuario: arranca como copia del catálogo y cambia solo si el usuario le pone
 * otro. Los nombres que alguien ya personalizó no se tocan.
 */
return new class extends Migration
{
    /**
     * tabla del catálogo => alias en favoritos.favoritable_type
     */
    private const ORIGENES = [
        'productos' => 'producto',
        'clientes' => 'cliente',
        'puntoubicacion' => 'punto',
        'conductores' => 'conductor',
        'transportistas' => 'transportista',
        'vehiculos' => 'vehiculo',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (self::ORIGENES as $tabla => $alias) {
            DB::update("
                UPDATE favoritos f
                INNER JOIN `$tabla` t ON t.id = f.favoritable_id
                SET f.nombreCorto = t.nombreCorto
                WHERE f.favoritable_type = ?
                  AND (f.nombreCorto IS NULL OR f.nombreCorto = '')
            ", [$alias]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * Solo deshace las copias: un nombre distinto al del catálogo lo puso el
     * usuario y se conserva.
     *
     * @return void
     */
    public function down()
    {
        foreach (self::ORIGENES as $tabla => $alias) {
            DB::update("
                UPDATE favoritos f
                INNER JOIN `$tabla` t ON t.id = f.favoritable_id
                SET f.nombreCorto = NULL
                WHERE f.favoritable_type = ?
                  AND f.nombreCorto = t.nombreCorto
            ", [$alias]);
        }
    }
};
