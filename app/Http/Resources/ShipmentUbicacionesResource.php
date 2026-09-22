<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Punto de partida o llegada de un envío (fila de shipment_puntoubicacions).
 *
 * Ojo con el `id`: antes se devolvía el de la fila pivote, y cuando el
 * frontend reenviaba la guía en un PUT ese valor terminaba en
 * `id_puntoubicacion`, rompiendo la clave foránea contra el catálogo. Aquí
 * `id` es el del CATÁLOGO, igual que el que espera store()/update(); el de la
 * fila pivote queda disponible como `id_pivote`.
 */
class ShipmentUbicacionesResource extends JsonResource
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
            'id' => $this->id_puntoubicacion,
            'id_puntoubicacion' => $this->id_puntoubicacion,
            'id_pivote' => $this->id,
            'id_shipment' => $this->id_shipment,
            'ubigeo' => $this->ubigeo,
            'direccion' => $this->direccion,
            'codLocal' => $this->codLocal,
            'ruc' => $this->ruc,
            'tipo' => $this->tipo,
        ];
    }
}
