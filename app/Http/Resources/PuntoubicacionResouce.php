<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PuntoubicacionResouce extends JsonResource
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
            'id'=> $this->id,
            'ubigeo'=> $this->ubigeo,
            'direccion'=> $this->direccion,
            'codLocal'=> $this->codLocal,
            'ruc'=> $this->ruc,
            'isCompany'=> $this->isCompany,
            'fav'=> $this->fav,
            'nombreCorto'=> $this->nombreCorto,
            'fullubigeo'=> $this->ubigeo? $this->ubigeoRelation->fullubigeo:null,
        ];
    }

    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }
}
