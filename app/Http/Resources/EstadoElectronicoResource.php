<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EstadoElectronicoResource extends JsonResource
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
            'id_despatch'=> $this->id_despatch,
            'serie'=> $this->serie,
            'numero'=> $this->numero,
            'fecha'=> $this->fecha,
            'estado'=> $this->estado,
            'estadoSunat'=> $this->estadoSunat,
            'codigoSunat'=> $this->codigoSunat,
            'descripcion'=> $this->descripcion,
            'hashQr'=> $this->hashQr,
            'token'=>$this->token,
            'ticket'=>$this->ticket,
        ];
    }
}
