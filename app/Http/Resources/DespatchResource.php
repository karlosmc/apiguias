<?php

namespace App\Http\Resources;

use App\Models\EstadoElectronico;
use Illuminate\Http\Resources\Json\JsonResource;

class DespatchResource extends JsonResource
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
            'version'=>$this->version,
            'serie'=>$this->serie,
            'correlativo'=>$this->correlativo,
            'observacion'=>$this->observacion,
            'fechaEmision'=>$this->fechaEmision,
            'id_cliente'=>$this->id_cliente,
            'id_tercero'=>$this->id_tercero,
            'id_comprador'=>$this->id_comprador,
            'destinatario'=> new ClienteResouce($this->whenLoaded('clientes')),
            'tercero'=> new ClienteResouce($this->whenLoaded('terceros')),
            'comprador'=> new ClienteResouce($this->whenLoaded('compradores')),
            'envio'=> new ShipmentResource($this->whenLoaded('envio')),
            'details'=> DespatchProductoResource::collection($this->whenLoaded('details')),
            'addDocs'=> AdicionalResource::collection($this->whenLoaded('docsadicionales')),
            'electronico'=> new EstadoElectronicoResource($this->whenLoaded('electronico')),
            'id_user'=> $this->id_user,
            'migrado'=> $this->migrado,

        ];
    }
}
