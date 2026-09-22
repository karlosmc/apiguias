<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoElectronico extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'estado_electronico';

    protected $fillable = [
        'id',
        'id_despatch',
        'serie',
        'numero',
        'fecha',
        'estado',
        'estadoSunat',
        'descripcion',
        'rutaXml',
        'rutaPdf',
        'rutaCdr',
        'cdrbase64',
        'hash',
        'hashQr',
        'token',
        'ticket',
        'codigoSunat'
    ];

    public function despatch()
    {

        return $this->belongsTo(Despatch::class, 'id_despatch');
    }

    public function usuario()
    {
        return $this->despatch ? $this->despatch->usuario() : null;
    }
}
