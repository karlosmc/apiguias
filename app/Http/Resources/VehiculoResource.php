<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehiculoResource extends JsonResource
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
            'id'=>$this->id,
            'placa'=>$this->placa,
            'nroCirculacion'=>$this->nroCirculacion,
            'nroAutorizacion'=>$this->nroAutorizacion,
            'codEmisor'=>$this->codEmisor,
            'fav'=>$this->fav,
            'isCompany'=>$this->isCompany,
            'tracto'=>(bool) $this->tracto,
            'glp'=>(bool) $this->glp,
            'nombreCorto'=>$this->nombreCorto,
            'tipo'=>$this->whenPivotLoaded('shipment_vehiculo',function(){
                return $this->pivot->tipo;
            })
        ];
    }
}
