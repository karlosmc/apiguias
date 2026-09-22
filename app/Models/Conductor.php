<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\TieneFavoritos;

class Conductor extends Model
{
    use HasFactory, TieneFavoritos;

    protected $table = "conductores";
    // protected $primaryKey = 'id';
    // public $incrementing = true; // Asegúrate de que sea autoincremental si corresponde
    // protected $keyType = 'int'; // Asegúrate de que el tipo de clave primaria sea correcto

    protected $fillable=[
        'nroDoc',
        'nombres',
        'apellidos',
        'licencia',
        'isCompany',
        'id_tipodocumento'
    ];

    public function tipoDocumentos(){
        return $this->belongsTo(TipoDocumento::class,'id_tipodocumento');
    }

    public function shipments(){
        return $this->belongsToMany(Shipment::class, 'shipment_conductor', 'id_conductor', 'id_shipment');
    }
    
}
