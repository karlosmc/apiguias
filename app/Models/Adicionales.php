<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adicionales extends Model
{
    use HasFactory;

    protected $table='adicionales';

    protected $fillable = [
        'id_despatch',
        'tipoDesc',
        'tipo',
        'nro',
        'emisor'
    ];

    public function despatch(){
        return $this->belongsTo(Despatch::class);
    }
}
