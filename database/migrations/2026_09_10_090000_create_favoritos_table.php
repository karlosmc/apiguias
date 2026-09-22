<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Favoritos por usuario.
 *
 * Sustituye a la columna compartida `fav` de productos, clientes,
 * puntoubicacion, conductores, transportistas y vehiculos. Las columnas `fav`
 * NO se eliminan: quedan como respaldo del estado anterior por si hay que
 * volver atrás.
 */
return new class extends Migration
{
    /**
     * tabla => alias del morph map (ver AppServiceProvider::TIPOS_FAVORITOS)
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
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('favoritable_type', 100);
            $table->unsignedBigInteger('favoritable_id');
            $table->timestamps();

            $table->unique(['id_user', 'favoritable_type', 'favoritable_id'], 'favoritos_unico');
            $table->index(['favoritable_type', 'favoritable_id'], 'favoritos_favoritable');
        });

        $this->copiarFavoritosExistentes();
    }

    /**
     * Cada usuario hereda los favoritos que hoy están marcados en la columna
     * `fav`, para que nadie note un cambio al entrar la primera vez.
     */
    private function copiarFavoritosExistentes()
    {
        $usuarios = DB::table('users')->pluck('id');

        if ($usuarios->isEmpty()) {
            return;
        }

        $ahora = now();

        foreach (self::ORIGENES as $tabla => $alias) {
            if (! Schema::hasTable($tabla) || ! Schema::hasColumn($tabla, 'fav')) {
                continue;
            }

            DB::table($tabla)->where('fav', 1)->orderBy('id')->chunkById(500, function ($registros) use ($usuarios, $alias, $ahora) {
                $filas = [];

                foreach ($registros as $registro) {
                    foreach ($usuarios as $idUser) {
                        $filas[] = [
                            'id_user' => $idUser,
                            'favoritable_type' => $alias,
                            'favoritable_id' => $registro->id,
                            'created_at' => $ahora,
                            'updated_at' => $ahora,
                        ];
                    }
                }

                foreach (array_chunk($filas, 1000) as $lote) {
                    DB::table('favoritos')->insert($lote);
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favoritos');
    }
};
