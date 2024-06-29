<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransportistaResource extends JsonResource
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
            'numDoc'=> $this->numDoc,
            'rznSocial'=> $this->rznSocial,
            'fav'=> $this->fav,
            'tipodocumento'=> $this->id_tipodocumento? $this->tipoDocumentos->valor:null,
            'tipoDoc'=> $this->id_tipodocumento? $this->tipoDocumentos->tipoDoc:null,
            'nombreCorto'=> $this->nombreCorto,
            'nroMtc'=>$this->nroMtc,
        ];
    }
}
