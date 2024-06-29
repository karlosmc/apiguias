<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoEmision extends Model
{
    use HasFactory;

    protected $table='puntos_emision';

    protected $fillable = [
        'codigo',
        'nombre',
        'codlocal',
        'direccion',
        'ruc'
    ];

    public function users(){
        return $this->belongsToMany(User::class,'users_puntoemision','id_puntoemision','id_users');
    }
}
