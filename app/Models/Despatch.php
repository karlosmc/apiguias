<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despatch extends Model
{
    use HasFactory;

    protected $table="despatches";

    protected $fillable = [
        'version',
        'serie',
        'correlativo',
        'observacion',
        'fechaEmision',
        'id_cliente',
        'id_tercero',
        'id_comprador',
        'id_user'
    ];

    public function clientes(){
        return $this->belongsTo(Cliente::class,'id_cliente');
    }
    public function terceros(){
        return $this->belongsTo(Cliente::class,'id_tercero');
    }
    public function compradores(){
        return $this->belongsTo(Cliente::class,'id_comprador');
    }
    public function envio(){
        return $this->hasOne(Shipment::class,'id_despatch');
    }

    public function electronico(){
        return $this->hasOne(EstadoElectronico::class,'id_despatch');
    }
    
    public function usuario(){
        return $this->belongsTo(User::class, 'id_user');
    }
    
    public function productos(){
        return $this->belongsToMany(Producto::class,'despatch_productos','id_despatch','id_producto');
    }

    public function docsadicionales(){
        return $this->hasMany(Adicionales::class,'id_despatch');
    }
    
    public function scops(){
        return $this->hasMany(Scop::class,'id_despatch');
    }

    public function details(){
        return $this->hasMany(DespatchProducto::class,'id_despatch');
    }
}
