<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentVehiculo extends Model
{
    use HasFactory;


    protected $table='shipment_vehiculo';

    protected $fillable = [
        'id_shipment',
        'id_vehiculo',
        'tipo'
    ];
}
