<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReactivoResource extends JsonResource
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
            'data' => [
                'id' => $this->id,
                'attributes' => [
                    'pregunta' => $this->pregunta,
                    'respuesta' => $this->respuesta_correcta,
                ],
                'relationships' => [
                    new CompetenciaResource($this->competencia),
                    new TipoReactivoResource($this->tipo),
                    new EstatusResource($this->estatus),
                    new ProfesorResource($this->profesor),
                    // new ComentarioResource($this->comentario),
                ],
            ],
        ];
    }
}
