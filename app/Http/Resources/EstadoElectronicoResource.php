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
            'rutaXml'=> $this->rutaXml,
            'rutaPdf'=> $this->rutaPdf,
            'rutaCdr'=> $this->rutaCdr,
            'hash'=> $this->hash,
            'hashQr'=> $this->hashQr,
            'token'=>$this->token,
            'ticket'=>$this->ticket,
            'id_user'=>$this->despatch?$this->despatch->id_user:null,
            'name'=>$this->usuario?$this->usuario->name:null,
        ];
    }
}