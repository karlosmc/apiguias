<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\TieneFavoritos;

class Cliente extends Model
{
    use HasFactory, TieneFavoritos;

    protected $table = "clientes";
    
    protected $fillable=[
        'numDoc',
        'rznSocial',
        'email',
        'telephone',
        'isCompany',
        'id_tipodocumento',
    ];

    public function tipoDocumentos(){
        return $this->belongsTo(TipoDocumento::class,'id_tipodocumento');
    }
}


