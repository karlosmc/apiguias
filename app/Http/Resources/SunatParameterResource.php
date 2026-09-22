<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SunatParameterResource extends JsonResource
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
            'client_id'=> $this->client_id,
            'client_secret'=> $this->client_secret,
            'username'=>$this->username,
            'password'=>$this->password,
            'scope'=>$this->scope,
            'grant_type'=>$this->grant_type,
            'env'=> $this->env,
            'endpointurl'=> $this->endpointurl,
            'certificado'=> $this->certificado,
            'clavecertificado'=> $this->clavecertificado,
            'urlsend'=> $this->urlsend,
            'urlconsult'=> $this->urlconsult,
            'id_empresa'=>$this->id_empresa,
            'ruc'=>$this->id_empresa?$this->empresa->ruc:null,
            'folder'=>$this->id_empresa?$this->empresa->folder:null,
            'activo'=>$this->activo,
            'nombre'=>$this->nombre,
        ];
    }
}
