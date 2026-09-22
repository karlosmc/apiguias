<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumeracionVehiculos extends Model
{
    use HasFactory;

    protected $table='numeracion_vehiculos';
    protected $fillable=[
        'id_numeracion',
        'id_primario',
        'id_secundario'
    ];



  

}
