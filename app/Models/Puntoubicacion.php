<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\TieneFavoritos;

class Puntoubicacion extends Model
{
    use HasFactory, TieneFavoritos;
    protected $table = 'puntoubicacion';
    protected $fillable = [
        'ubigeo',
        'direccion',
        'codLocal',
        'ruc',
        'isCompany',
        'rznSocial'
    ];

    public function ubigeoRelation(){
        
        return $this->belongsTo(Ubigeo::class,'ubigeo','ubigeo');
    }

    public function despatches(){
        return $this->belongsToMany(Shipment::class, 'shipment_puntoubicacions', 'id_puntoubicacion', 'id_shipment');
    }
    /** Usuario y clave del PVO de Osinergmin (solo establecimientos propios). */
    public function credencialPvo()
    {
        return $this->hasOne(CredencialPvo::class, 'id_puntoubicacion');
    }

    public function almacenesFafio()
    {
        return $this->hasMany(AlmacenFafio::class, 'id_punto_ubicacion');
    }
}
