<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'codigo',
        'codProdSunat',
        'descripcion',
        'unidad',
        'fav',
        'id_user',
        'nombreCorto'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function despatches(){

        return $this->belongsToMany(Despatch::class, 'despatch_productos', 'id_producto', 'id_despatch');
    }
        
}

