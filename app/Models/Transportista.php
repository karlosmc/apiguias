<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportista extends Model
{
    use HasFactory;

    protected $table='transportistas';

    protected $fillable = [
        'numDoc',
        'rznSocial',
        'fav',
        'nombreCorto',
        'id_tipodocumento',
        'nroMtc'
    ];

    public function tipoDocumentos(){
        return $this->belongsTo(TipoDocumento::class,'id_tipodocumento');
    }

}
