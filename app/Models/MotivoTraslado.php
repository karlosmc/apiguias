<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoTraslado extends Model
{
    use HasFactory;

    protected $table="motivo_traslado";

    protected $fillable=[
      'codTraslado',
      'desTraslado'
    ];
}
