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
            'id' => $this->id,
            'evaluacion_id' => $this->evaluacion_id,
            'profesor_id' => $this->evaluacion_id,
            'matricula' => $this->matricula,
            'duracion' => $this->duracion,
            'fecha_creacion' => $this->fecha_creacion,
            'fecha_aplicacion' => $this->fecha_aplicacion,
            'status' => $this->status,
        ];
    }
}
