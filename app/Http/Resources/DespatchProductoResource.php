<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DespatchProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_despatch'=>$this->id_despatch,
            'id_producto'=>$this->id_producto,
            'codigo'=>$this->codigo,
            'codProdSunat'=>$this->codProdSunat,
            'descripcion'=>$this->descripcion,
            'unidad'=>$this->unidad,
            'cantidad'=>$this->cantidad
        ];
    }
}
