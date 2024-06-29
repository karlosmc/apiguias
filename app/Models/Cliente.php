<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "clientes";
    
    protected $fillable=[
        'numDoc',
        'rznSocial',
        'email',
        'telephone',
        'fav',
        'isCompany',
        'id_tipodocumento',
        'nombreCorto'
    ];

    public function tipoDocumentos(){
        return $this->belongsTo(TipoDocumento::class,'id_tipodocumento');
    }
}


