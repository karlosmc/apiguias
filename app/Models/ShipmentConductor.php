<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentConductor extends Model
{
    use HasFactory;

    protected $table='shipment_conductor';
    
    protected $fillable = [
        'id_shipment',
        'id_conductor',
        'tipo'
    ];
}
