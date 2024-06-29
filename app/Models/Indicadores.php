<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicadores extends Model
{
    use HasFactory;


    protected $table = 'indicadores';

    protected $fillable = [
        'indicador',
        'textoCorto',
        'tooltip',
        'icono',
        'flag'
    ];


    public function shipments(){

        return $this->belongsToMany(Shipment::class, 'shipment_indicadores', 'id_indicadores', 'id_shipment');
    }
}
