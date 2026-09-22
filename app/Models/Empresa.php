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
        'folder'

    ];


    public function parametros(){

        return $this->hasMany(SunatParameters::class,'id_empresa');
    }
}
