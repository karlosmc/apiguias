<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Un SCOP, un registro: `nroScop` pasa a ser único en scop_temporal (las
 * cargas ahora insertan o actualizan, ver ScopTemporalSincronizacion).
 *
 * Antes de crear el índice se juntan los duplicados que ya existan: queda la
 * fila actualizada más recientemente, y sus campos vacíos se completan con el
 * último valor no vacío de las otras (ningún dato se pierde por un vacío).
 */
return new class extends Migration
{
    private const CAMPOS = [
        'factura', 'proveedor', 'fechaPedido', 'fechaVenta', 'fechaDespacho',
        'estadoPedido', 'producto', 'placa', 'volumen', 'unidadMedida',
    ];

    public function up()
    {
        // Espacios sobrantes: " 123" y "123" son el mismo SCOP
        DB::table('scop_temporal')->update(['nroScop' => DB::raw('TRIM(nroScop)')]);

        $repetidos = DB::table('scop_temporal')
            ->select('nroScop')
            ->groupBy('nroScop')
            ->havingRaw('count(*) > 1')
            ->pluck('nroScop');

        foreach ($repetidos as $nroScop) {
            $filas = DB::table('scop_temporal')
                ->where('nroScop', $nroScop)
                ->orderByDesc('updated_at')
                ->orderByDesc('id')
                ->get();

            $queda = $filas->first();
            $completar = [];

            foreach (self::CAMPOS as $campo) {
                if ($queda->$campo !== null && $queda->$campo !== '') {
                    continue;
                }

                $otra = $filas->first(fn ($f) => $f->$campo !== null && $f->$campo !== '');
                if ($otra) {
                    $completar[$campo] = $otra->$campo;
                }
            }

            if ($completar) {
                DB::table('scop_temporal')->where('id', $queda->id)->update($completar);
            }

            DB::table('scop_temporal')
                ->where('nroScop', $nroScop)
                ->where('id', '!=', $queda->id)
                ->delete();
        }

        Schema::table('scop_temporal', function (Blueprint $table) {
            $table->dropIndex('scop_temporal_nroscop');
            $table->unique('nroScop', 'scop_temporal_nroscop_unico');
        });
    }

    public function down()
    {
        Schema::table('scop_temporal', function (Blueprint $table) {
            $table->dropUnique('scop_temporal_nroscop_unico');
            $table->index('nroScop', 'scop_temporal_nroscop');
        });
    }
};
