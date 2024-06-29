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
    ];

    public static function getSunatParams($enviroment){
        
        $id_empresa = Empresa::all()->first()->id;
        
        $row = self::where('id_empresa',$id_empresa)
                    ->where('env',$enviroment)->first();
        
        return $row;
    }
}
