<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table='empresa';

    protected $fillable = [
        'razonSocial',
        'email',
        'ruc',
        'logo',
        'folder',
        // Conexión con la API de facturación (ver FacturacionApiService)
        'fe_api_url',
        'fe_api_token',
        'fe_webhook_secret',
    ];

    // Nunca salen en un JSON de la empresa
    protected $hidden = ['fe_api_token', 'fe_webhook_secret'];

    // Cifrados con el APP_KEY: si cambia, hay que volver a cargarlos
    protected $casts = [
        'fe_api_token' => 'encrypted',
        'fe_webhook_secret' => 'encrypted',
    ];


    public function parametros(){

        return $this->hasMany(SunatParameters::class,'id_empresa');
    }
}
