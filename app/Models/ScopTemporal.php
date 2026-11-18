<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * SCOP que carga otra aplicación para elegirlos por placa en el front.
 * Se agrupan por `lote` (una carga) para borrarlos juntos.
 */
class ScopTemporal extends Model
{
    protected $table = 'scop_temporal';

    protected $fillable = [
        'lote',
        'nroScop',
        'factura',
        'proveedor',
        'fechaPedido',
        'fechaVenta',
        'fechaDespacho',
        'estadoPedido',
        'producto',
        'placa',
        'id_puntoubicacion',
        'volumen',
        'unidadMedida',
    ];

    protected $casts = [
        'fechaPedido' => 'datetime',
        'fechaVenta' => 'datetime',
        'fechaDespacho' => 'datetime',
        'volumen' => 'float',
    ];

    /** Establecimiento del SCOP (líquidos); null en GLP o si no se envió. */
    public function establecimiento()
    {
        return $this->belongsTo(Puntoubicacion::class, 'id_puntoubicacion');
    }

    /** Placa comparable: "abc-123 " → "ABC123". */
    public static function normalizarPlaca($placa)
    {
        return strtoupper(preg_replace('/[^A-Za-z0-9]/', '', (string) $placa));
    }
}
