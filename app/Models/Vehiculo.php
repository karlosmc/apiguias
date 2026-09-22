<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\TieneFavoritos;

class Vehiculo extends Model
{
    use HasFactory, TieneFavoritos;

    protected $table ='vehiculos';

    protected $fillable = [
        'placa',
        'nroCirculacion',
        'nroAutorizacion',
        'codEmisor',
        'isCompany',
        'tracto',
        'glp',
    ];

    protected $casts = [
        'tracto' => 'boolean',
        'glp' => 'boolean',
    ];


    public function shipments(){

        return $this->belongsToMany(Shipment::class, 'shipment_vehiculo', 'id_vehiculo', 'id_shipment');
    }

    // public function numeracion(){
    //     return $this->belongsToMany(Numeracion::class,'numeracion_vehiculos','id_primario','id_numeracion');
    // }


}
