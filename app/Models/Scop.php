<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

/**
 * Número de SCOP asociado a una guía. Una guía puede tener varios o ninguno,
 * pero un mismo número no puede estar en dos guías a la vez.
 */
class Scop extends Model
{
    use HasFactory;

    protected $table = 'scop';

    protected $fillable = [
        'nroScop',
        'id_despatch',
    ];

    public function despatch()
    {
        return $this->belongsTo(Despatch::class, 'id_despatch');
    }

    /**
     * Acepta lo que mande el frontend y devuelve una lista limpia de números:
     * un string suelto, un array de strings o un array de objetos con nroScop.
     * Quita vacíos y repetidos conservando el orden.
     */
    public static function normalizar($valor)
    {
        if ($valor === null || $valor === '') {
            return [];
        }

        $numeros = [];

        foreach ((array) $valor as $item) {
            if (is_array($item)) {
                $item = $item['nroScop'] ?? null;
            }

            $item = trim((string) $item);

            if ($item !== '' && ! in_array($item, $numeros, true)) {
                $numeros[] = $item;
            }
        }

        return $numeros;
    }

    /**
     * Regla de validación "este número está libre". Al actualizar una guía hay
     * que ignorar sus propias filas, que obviamente ya lo tienen ocupado.
     */
    public static function reglaLibre($ignorarDespatch = null)
    {
        return Rule::unique('scop', 'nroScop')
            ->when($ignorarDespatch, function ($regla) use ($ignorarDespatch) {
                return $regla->where(function ($query) use ($ignorarDespatch) {
                    return $query->where('id_despatch', '!=', $ignorarDespatch);
                });
            });
    }

    /**
     * Los números de la lista que ya están usados por otra guía.
     *
     * @param  int|null  $ignorarDespatch  no cuenta como ocupado lo que ya es de esta guía
     * @param  bool  $bloquear  SELECT ... FOR UPDATE, para guardados simultáneos
     * @param  int|null  $ignorarId  no cuenta como ocupada esta fila concreta
     * @return \Illuminate\Support\Collection<int, static>
     */
    public static function ocupados(array $numeros, $ignorarDespatch = null, $bloquear = false, $ignorarId = null)
    {
        if (! $numeros) {
            return collect();
        }

        $query = static::with('despatch')->whereIn('nroScop', $numeros);

        if ($ignorarDespatch) {
            $query->where('id_despatch', '!=', $ignorarDespatch);
        }

        if ($ignorarId) {
            $query->where('id', '!=', $ignorarId);
        }

        if ($bloquear) {
            $query->lockForUpdate();
        }

        return $query->get();
    }

    /**
     * Qué número está en qué guía, para las respuestas de error.
     */
    public static function detalle($filas)
    {
        return collect($filas)->map(function ($scop) {
            return [
                'nroScop' => $scop->nroScop,
                'id_despatch' => $scop->id_despatch,
                'guia' => $scop->despatch
                    ? $scop->despatch->serie . '-' . $scop->despatch->correlativo
                    : null,
            ];
        })->values();
    }
}
