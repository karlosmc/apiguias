<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $table='shipments';

    protected $fillable = [
        'indTransbordo',
        'sustentoPeso',
        'pesoItems',
        'pesoTotal',
        'undPesoTotal',
        'numBultos',
        'fecTraslado',
        'estado',
        'id_puerto',
        'id_aeropuerto',
        'id_mottraslado',
        'id_modtraslado',
        'id_despatch'
    ];

    public function puerto(){
        return $this->belongsTo(Puerto::class,'id_puerto');
    }

    public function aeropuerto(){
        return $this->belongsTo(Puerto::class,'id_aeropuerto');
    }

    public function motivoTraslado(){
        return $this->belongsTo(MotivoTraslado::class,'id_mottraslado');
    }
    public function modalidadTraslado(){
        return $this->belongsTo(ModalidadTraslado::class,'id_modtraslado');
    }

    public function partida(){
        return $this->belongsTo(Puntoubicacion::class,'id_partida');
    }

    public function llegada(){
        return $this->belongsTo(Puntoubicacion::class,'id_llegada');
    }

    public function transportista(){
        return $this->belongsTo(Transportista::class,'id_transportista');
    }

    public function indicadores(){
        return $this->belongsToMany(Indicadores::class,'shipment_indicadores','id_shipment','id_indicadores');
    }

    public function vehiculos(){
        return $this->belongsToMany(Vehiculo::class,'shipment_vehiculo','id_shipment','id_vehiculo');
    }

    public function conductores(){
        return $this->belongsToMany(Conductor::class,'shipment_conductor','id_shipment','id_conductor');
    }
    public function despatch(){
        return $this->hasOne(Despatch::class,'id_despatch');
    }
}
