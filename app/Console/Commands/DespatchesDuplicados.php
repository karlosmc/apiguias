<?php

namespace App\Console\Commands;

use App\Models\Despatch;
use App\Models\Shipment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Lista (y opcionalmente elimina) guías repetidas serie + correlativo.
 *
 * Hay que dejar la tabla limpia antes de que la migración
 * 2026_06_08_163930_add_column_despatch_table pueda crear el índice único.
 */
class DespatchesDuplicados extends Command
{
    protected $signature = 'despatches:duplicados
                            {--eliminar : Borra de verdad las copias sobrantes (por defecto solo informa)}';

    protected $description = 'Revisa las guías duplicadas por serie y correlativo';

    /**
     * Cuanto más alto, más "definitiva" es la guía y menos se debe borrar.
     */
    private const PESO_ESTADO = [
        'F' => 5, // aceptada por SUNAT
        'C' => 4, // informada / anulada en SUNAT
        'B' => 3, // dada de baja
        'S' => 2, // enviada, esperando respuesta
        'E' => 1, // enviada con error (suele ser la copia rechazada por SUNAT)
        'P' => 0, // pendiente de envío, nunca salió del sistema
    ];

    /**
     * Estados que significan "SUNAT ya sabe de esta guía": si hay dos así en el
     * mismo grupo no se borra ninguna automáticamente.
     */
    private const ESTADOS_DEFINITIVOS = ['F', 'C', 'B', 'S'];

    public function handle()
    {
        $grupos = DB::table('despatches')
            ->select('serie', 'correlativo', DB::raw('count(*) as total'))
            ->groupBy('serie', 'correlativo')
            ->havingRaw('count(*) > 1')
            ->orderBy('serie')
            ->orderBy('correlativo')
            ->get();

        if ($grupos->isEmpty()) {
            $this->info('No hay guías duplicadas. Ya puedes correr las migraciones.');

            return self::SUCCESS;
        }

        $eliminar = $this->option('eliminar');
        $filas = [];
        $aBorrar = [];
        $revisarManual = [];

        foreach ($grupos as $grupo) {
            $guias = Despatch::with(['electronico', 'usuario'])
                ->where('serie', $grupo->serie)
                ->where('correlativo', $grupo->correlativo)
                ->orderBy('id')
                ->get();

            $definitivas = $guias->filter(function ($guia) {
                return in_array(optional($guia->electronico)->estado, self::ESTADOS_DEFINITIVOS, true);
            });

            // Dos guías ya enviadas o dadas de baja: eso lo decide una persona.
            $ambigua = $definitivas->count() > 1;

            $conservar = $guias->sortByDesc(function ($guia) {
                return [self::PESO_ESTADO[optional($guia->electronico)->estado] ?? -1, -$guia->id];
            })->first();

            foreach ($guias as $guia) {
                $esConservada = $guia->id === $conservar->id;

                $filas[] = [
                    $guia->serie . '-' . $guia->correlativo,
                    $guia->id,
                    optional($guia->electronico)->estado ?? '-',
                    optional($guia->usuario)->name ?? $guia->id_user,
                    (string) $guia->created_at,
                    $ambigua ? 'REVISAR' : ($esConservada ? 'se conserva' : 'sobra'),
                ];

                if (! $ambigua && ! $esConservada) {
                    $aBorrar[] = $guia->id;
                }
            }

            if ($ambigua) {
                $revisarManual[] = $grupo->serie . '-' . $grupo->correlativo;
            }
        }

        $this->table(['Guía', 'id', 'Estado', 'Usuario', 'Creada', 'Acción'], $filas);

        if ($revisarManual) {
            $this->warn('Estas guías tienen más de una copia ya enviada o dada de baja, no se tocan: ' . implode(', ', $revisarManual));
        }

        if (! $aBorrar) {
            $this->info('No hay nada que se pueda borrar automáticamente.');

            return self::SUCCESS;
        }

        if (! $eliminar) {
            $this->info(count($aBorrar) . ' guías sobrantes. Vuelve a ejecutar con --eliminar para borrarlas.');

            return self::SUCCESS;
        }

        if ($this->input->isInteractive() && ! $this->confirm('¿Borrar ' . count($aBorrar) . ' guías y todo lo que cuelga de ellas?')) {
            return self::SUCCESS;
        }

        DB::transaction(function () use ($aBorrar) {
            // shipments no tiene clave foránea hacia despatches, así que hay que
            // borrarlo a mano; sus hijos sí caen por cascada.
            Shipment::whereIn('id_despatch', $aBorrar)->delete();

            // detalles, adicionales y estado electrónico caen por cascada
            Despatch::whereIn('id', $aBorrar)->delete();
        });

        $this->info('Borradas ' . count($aBorrar) . ' guías duplicadas.');

        return self::SUCCESS;
    }
}
