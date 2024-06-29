<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table ='vehiculos';

    protected $fillable = [
        'placa',
        'nroCirculacion',
        'nroAutorizacion',
        'codEmisor',
        'fav',
        'isCompany',
        'nombreCorto',
    ];

    
    public function shipments(){

        return $this->belongsToMany(Shipment::class, 'shipment_vehiculo', 'id_vehiculo', 'id_shipment');
    }
}
