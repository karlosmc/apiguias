<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConductorResource extends JsonResource
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
            'tipo'=> $this->tipo,
            'nroDoc'=> $this->nroDoc,
            'nombres'=>$this->nombres,
            'apellidos'=>$this->apellidos,
            'licencia'=>$this->licencia,
            'nombreCorto'=>$this->nombreCorto,
            'fav'=> $this->fav,
            'isCompany'=> $this->isCompany,
            'tipodocumento'=> $this->id_tipodocumento? $this->tipoDocumentos->valor:null,
            'tipoDoc'=> $this->id_tipodocumento? $this->tipoDocumentos->tipoDoc:null,
        ];
    }
}
