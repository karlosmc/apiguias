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

    // public function primarios(){
    //     return $this->belongsToMany(Vehiculo::class,'numeracion_vehiculos','id_numeracion','id_primario');
    // }

    // public function secundarios(){
    //     return $this->belongsToMany(Vehiculo::class,'numeracion_vehiculos','id_numeracion','id_secundario');
    // }

    // public function detalles()
    // {
    //     return $this->hasMany(NumeracionVehiculos::class, 'id_numeracion');
    // }

    public function vehiculoPrimario()
    {
        return $this->belongsToMany(Vehiculo::class,'numeracion_vehiculos','id_numeracion','id_primario');
    }

    // Relación con vehículos secundarios (muchos a muchos)
    public function vehiculosSecundarios()
    {
        return $this->belongsToMany(Vehiculo::class, 'numeracion_vehiculos', 'id_numeracion', 'id_secundario');
    }

    // public function puntoEmision(){
    //     return $this->hasOne(PuntoEmision::class,'id_puntoemision','id');
    // }

    public function puntoEmision()
    {
        return $this->belongsTo(PuntoEmision::class, 'id_puntoemision');
    }

}


