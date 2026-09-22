<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AlmacenFafio;

class ShipmentPuntoubicacion extends Model
{
    use HasFactory;

    protected $table='shipment_puntoubicacions';

    protected $fillable = [
        'id_shipment',
        'id_puntoubicacion',
        'ubigeo',
        'direccion',
        'codLocal',
        'ruc',
        'tipo'
    ];

    public function almacenesFafio()
    {
        return $this->hasMany(AlmacenFafio::class, 'id_punto_ubicacion', 'id_puntoubicacion');
    }
}
