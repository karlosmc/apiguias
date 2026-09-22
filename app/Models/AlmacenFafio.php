<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlmacenFafio extends Model
{
    use HasFactory;

    protected $table = 'almacen_fafio';

    protected $fillable = [
        'id_almacen_fafio',
        'id_punto_ubicacion',
        'nombre',
        'entrada',
        'salida'
    ];

    public function puntoUbicacion()
    {
        return $this->belongsTo(PuntoUbicacion::class, 'id_punto_ubicacion');
    }
}
