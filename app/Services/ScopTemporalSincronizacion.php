<?php

namespace App\Services;

use App\Models\ScopTemporal;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

/**
 * Carga de SCOP en scop_temporal como INSERTAR O ACTUALIZAR: un SCOP
 * (`nroScop`) es un único registro.
 *
 *  - No existe            → se inserta (con el lote de la carga).
 *  - Existe y algo cambió → se actualizan SOLO los campos que cambiaron.
 *  - Existe y es igual    → no se toca.
 *
 * Un dato nunca se borra con un vacío: si llega sin factura, se conserva la
 * que ya estaba. El lote no cambia al actualizar (es la carga en que el SCOP
 * entró por primera vez).
 *
 * `analizar()` no escribe nada (POST /api/scop-temporal/verificar);
 * `aplicar()` hace lo mismo y lo guarda (POST /api/scop-temporal).
 */
class ScopTemporalSincronizacion
{
    /** Campos que se comparan y actualizan (además de nroScop). */
    public const CAMPOS = [
        'factura', 'proveedor', 'fechaPedido', 'fechaVenta', 'fechaDespacho',
        'estadoPedido', 'producto', 'placa', 'id_puntoubicacion', 'volumen', 'unidadMedida',
    ];

    /**
     * Columna → nombre en la API, cuando difieren. La app manda y recibe
     * `idEstablecimiento` (el id de GET /api/movil/maestros).
     */
    public const NOMBRE_API = [
        'id_puntoubicacion' => 'idEstablecimiento',
    ];

    private const FECHAS = ['fechaPedido', 'fechaVenta', 'fechaDespacho'];

    /**
     * Vista previa: qué pasaría con estos registros, sin guardar nada.
     *
     * @return array{nuevos: array, cambios: array, iguales: array, repetidos: int}
     *   nuevos:  [nroScop => datos normalizados]
     *   cambios: [nroScop => ['id' => int, 'cambios' => [campo => ['antes' => x, 'despues' => y]]]]
     *   iguales: [nroScop, ...]
     *   repetidos: cuántos registros de la petición repetían un nroScop (se juntan)
     */
    public function analizar(array $registros, $bloquear = false)
    {
        $entrantes = [];
        $repetidos = 0;

        // El mismo SCOP dos veces en la petición: se junta, y lo no vacío que
        // venga después pisa a lo anterior
        foreach ($registros as $r) {
            $datos = $this->normalizar($r);
            $nro = $datos['nroScop'];

            if (isset($entrantes[$nro])) {
                $repetidos++;
                $entrantes[$nro] = array_merge($entrantes[$nro], array_filter($datos, fn ($v) => $v !== null));
            } else {
                $entrantes[$nro] = $datos;
            }
        }

        // Arreglo simple, no Collection::merge(): un nroScop numérico ("100")
        // es llave numérica y merge() renumeraría las llaves
        $existentes = [];
        foreach (array_chunk(array_keys($entrantes), 1000) as $bloque) {
            $consulta = DB::table('scop_temporal')->whereIn('nroScop', array_map('strval', $bloque));
            if ($bloquear) {
                $consulta->lockForUpdate();
            }
            foreach ($consulta->get() as $fila) {
                $existentes[(string) $fila->nroScop] = $fila;
            }
        }

        $nuevos = [];
        $cambios = [];
        $iguales = [];

        foreach ($entrantes as $nro => $datos) {
            $actual = $existentes[(string) $nro] ?? null;

            if (! $actual) {
                $nuevos[$nro] = $datos;
                continue;
            }

            $diferencias = [];
            foreach (self::CAMPOS as $campo) {
                $nuevo = $datos[$campo];

                // Vacío no borra: se conserva lo que ya estaba
                if ($nuevo === null) {
                    continue;
                }

                $antes = $this->valorGuardado($campo, $actual->$campo);
                if (! $this->igual($campo, $antes, $nuevo)) {
                    $diferencias[$campo] = ['antes' => $antes, 'despues' => $nuevo];
                }
            }

            if ($diferencias) {
                $cambios[$nro] = ['id' => $actual->id, 'cambios' => $diferencias];
            } else {
                $iguales[] = (string) $nro;
            }
        }

        return compact('nuevos', 'cambios', 'iguales', 'repetidos');
    }

    /**
     * Guarda: inserta los nuevos (con $lote) y actualiza solo los campos que
     * cambiaron. Todo o nada. Si otra carga simultánea insertó el mismo SCOP
     * un instante antes (índice único), se vuelve a analizar una vez.
     */
    public function aplicar(array $registros, $lote)
    {
        for ($intento = 1; ; $intento++) {
            try {
                return DB::transaction(function () use ($registros, $lote) {
                    $analisis = $this->analizar($registros, true);
                    $ahora = now();

                    $filas = array_map(fn ($datos) => $datos + [
                        'lote' => $lote,
                        'created_at' => $ahora,
                        'updated_at' => $ahora,
                    ], array_values($analisis['nuevos']));

                    foreach (array_chunk($filas, 500) as $bloque) {
                        ScopTemporal::insert($bloque);
                    }

                    foreach ($analisis['cambios'] as $cambio) {
                        $valores = array_map(fn ($c) => $c['despues'], $cambio['cambios']);
                        DB::table('scop_temporal')->where('id', $cambio['id'])->update($valores + ['updated_at' => $ahora]);
                    }

                    return $analisis;
                });
            } catch (QueryException $e) {
                if ($intento >= 2 || ! $this->esDuplicado($e)) {
                    throw $e;
                }
            }
        }
    }

    /** Registro de la petición → valores listos para comparar y guardar (vacío = null). */
    public function normalizar(array $r)
    {
        $datos = ['nroScop' => trim((string) $r['nroScop'])];

        foreach (self::CAMPOS as $campo) {
            $valor = $r[self::NOMBRE_API[$campo] ?? $campo] ?? null;
            $valor = is_string($valor) ? trim($valor) : $valor;

            if ($valor === null || $valor === '') {
                $datos[$campo] = null;
            } elseif ($campo === 'id_puntoubicacion') {
                $datos[$campo] = (int) $valor;
            } elseif (in_array($campo, self::FECHAS, true)) {
                $datos[$campo] = Carbon::parse($valor)->format('Y-m-d H:i:s');
            } elseif ($campo === 'placa') {
                $datos[$campo] = ScopTemporal::normalizarPlaca($valor) ?: null;
            } elseif ($campo === 'volumen') {
                $datos[$campo] = round((float) $valor, 4);
            } else {
                $datos[$campo] = (string) $valor;
            }
        }

        return $datos;
    }

    /** Valor tal como está en la BD, en el mismo formato que normalizar(). */
    private function valorGuardado($campo, $valor)
    {
        if ($valor === null || $valor === '') {
            return null;
        }

        if (in_array($campo, self::FECHAS, true)) {
            return Carbon::parse($valor)->format('Y-m-d H:i:s');
        }

        if ($campo === 'id_puntoubicacion') {
            return (int) $valor;
        }

        return $campo === 'volumen' ? round((float) $valor, 4) : (string) $valor;
    }

    /** Renombra las columnas al nombre de la API (id_puntoubicacion → idEstablecimiento). */
    public static function aApi(array $datos)
    {
        $salida = [];
        foreach ($datos as $campo => $valor) {
            $salida[self::NOMBRE_API[$campo] ?? $campo] = $valor;
        }

        return $salida;
    }

    private function igual($campo, $antes, $nuevo)
    {
        if ($campo === 'volumen') {
            return $antes !== null && abs($antes - $nuevo) < 0.00005;
        }

        return $antes === $nuevo;
    }

    private function esDuplicado(QueryException $e)
    {
        // 1062 = Duplicate entry (MySQL); 19 = constraint (SQLite)
        return in_array($e->errorInfo[1] ?? null, [1062, 19], true)
            && str_contains(strtolower($e->getMessage()), 'nroscop');
    }
}
