<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SunatParameters extends Model
{
    use HasFactory;

    protected $table='sunat_parameters';

    protected $fillable = [
        "client_id" ,
        "client_secret",
        "username",
        "password",
        "scope",
        "grant_type",
        "env",
        "endpointurl",
        "certificado",
        "urlsend",
        "clavecertificado",
        "urlconsult",
        "id_empresa",
        "nombre",
        "activo"
    ];

    public static function getSunatParams(){
        
        $id_empresa = Empresa::all()->first()->id;

        
        $sunatParameter = SunatParameters::where('activo', 1)
        ->where('id_empresa', $id_empresa)
        ->with('empresa')
        ->first();
        
        return $sunatParameter;
    }

    // public static function getSunaActiveParams(){
        
    //     $id_empresa = Empresa::all()->first()->id;

        
    //     $sunatParameter = SunatParameters::where('activo', 1)
    //     ->where('id_empresa', $id_empresa)
    //     ->with('empresa')
    //     ->first();
        
    //     return $sunatParameter;
    // }

    public function empresa(){
        return $this->belongsTo(Empresa::class,'id_empresa');
    }
}
