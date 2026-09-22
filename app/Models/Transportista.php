<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\TieneFavoritos;

class Transportista extends Model
{
    use HasFactory, TieneFavoritos;

    protected $table='transportistas';

    protected $fillable = [
        'numDoc',
        'rznSocial',
        'id_tipodocumento',
        'nroMtc'
    ];

    public function tipoDocumentos(){
        return $this->belongsTo(TipoDocumento::class,'id_tipodocumento');
    }

}
