<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DifusionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'difusion_id' => $this->id,
            'evaluacion_id' => $this->evaluacion_id,
            'profesor_id' => $this->evaluacion_id,
            'duracion' => $this->duracion,
            'fecha_creacion' => $this->fecha_creacion,
            'fecha_aplicacion' => $this->fecha_aplicacion,
            'fecha_limite' => $this->fecha_limite,
            'status' => $this->status,
        ];
    }
}
