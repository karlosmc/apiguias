<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        // $partida = $this->ubicaciones->firstWhere('tipo', 'P');
        // $llegada = $this->ubicaciones->firstWhere('tipo', 'L');
        $partida = $this->ubicaciones ? $this->ubicaciones->firstWhere('tipo', 'P') : null;
        $llegada = $this->ubicaciones ? $this->ubicaciones->firstWhere('tipo', 'L') : null;
        return [

            'id' => $this->id,
            'indTransbordo' => $this->indTransbordo,
            'sustentoPeso' => $this->sustentoPeso,
            'pesoItems' => $this->pesoItems,
            'pesoTotal' => $this->pesoTotal,
            'undPesoTotal' => $this->undPesoTotal,
            'numBultos' => $this->numBultos,
            'fecTraslado' => $this->fecTraslado,
            'fecInicioTrasladoBienes' => $this->fecInicioTrasladoBienes,
            'estado' => $this->estado,
            'id_puerto' => $this->id_puerto,
            'id_aeropuerto' => $this->id_aeropuerto,
            'id_mottraslado' => $this->id_mottraslado,
            'id_modtraslado' => $this->id_modtraslado,
            'id_despatch' => $this->id_despatch,
            'puerto' => $this->id_puerto,
            'aeropuerto' => $this->id_aeropuerto,
            'modTraslado' => $this->id_modtraslado ? $this->modalidadTraslado->modTraslado : null,
            'codTraslado' => $this->id_mottraslado ? $this->motivoTraslado->codTraslado : null,
            'desTraslado' => $this->id_mottraslado ? $this->motivoTraslado->desTraslado : null,
            'indicadores' => IndicadoresResource::collection($this->whenLoaded('indicadores')),
            // 'ubicaciones'=> PuntoubicacionResouce::collection($this->whenLoaded('ubicaciones')),
            // 'indicadores'=> ShipmentUbicacionesResource::collection($this->whenLoaded('ubicaciones')),
            'partida' => $partida ? new ShipmentUbicacionesResource($partida) : null,
            'llegada' => $llegada ? new ShipmentUbicacionesResource($llegada) : null,
            'vehiculo' => VehiculoResource::collection($this->whenLoaded('vehiculos')),
            'choferes' => ConductorResource::collection($this->whenLoaded('conductores')),
            'transportista' => new TransportistaResource($this->whenLoaded('transportista'))
        ];
    }
}
