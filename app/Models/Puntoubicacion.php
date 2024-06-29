<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntoubicacion extends Model
{
    use HasFactory;
    protected $table = 'puntoubicacion';
    protected $fillable = [
        'ubigeo',
        'direccion',
        'codLocal',
        'ruc',
        'isCompany',
        'fav',
        'nombreCorto'
    ];

    public function ubigeoRelation(){
        
        return $this->belongsTo(Ubigeo::class,'ubigeo','ubigeo');
    }
}
