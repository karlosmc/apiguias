<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numeracion extends Model
{
    use HasFactory;

    protected $table='numeracion';

    protected $fillable = [
        'nombre',
        'serie',
        'numeroActual',
        'id_puntoemision'
    ];
}
