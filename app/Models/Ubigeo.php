<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    use HasFactory;

    protected $table='ubigeos';

    public function puntoubicaciones(){
        return $this->hasMany(Puntoubicacion::class,'ubigeo','ubigeo');
    }
}
