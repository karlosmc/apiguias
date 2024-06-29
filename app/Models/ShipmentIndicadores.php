<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentIndicadores extends Model
{
    use HasFactory;

    protected $table='shipment_indicadores';
    protected $fillable = [
        'id_shipment',
        'id_indicadores'
    ];
}
