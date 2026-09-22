<?php

namespace App\Http\Resources;

use App\Models\Vehiculo;
use Illuminate\Http\Resources\Json\JsonResource;

class NumeracionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $primario = $this->vehiculoPrimario->first();

        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'serie' => $this->serie,
            'numeroActual' => $this->numeroActual,
            'primario' => new VehiculoResource($primario),
            'secundario' => VehiculoResource::collection($this->whenLoaded('vehiculosSecundarios')),
            'id_puntoemision'=>$this->id_puntoemision,
            'puntoemision' => new PuntoEmisionResource($this->whenLoaded('puntoEmision')), // Relación belongsTo, no necesitas collection
        ];
    }
}
