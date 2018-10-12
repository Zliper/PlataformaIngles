<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvaluacionResource extends JsonResource
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
            'profesor_id' => $this->profesor_id,
            'materia_id' => $this->materia_id,
            'catalogo_id' => $this->catalogo_id,
            'alumno_id' => $this->alumno_id,
            'punto_gramatical' => $this->punto_gramatical,
            'cantidad_reading' => $this->cantidad_reading,
            'cantidad_listening' => $this->cantidad_listening,
            'cantidad_writing' => $this->cantidad_writing,
            'nota' => $this->nota,
            'instruccion' => $this->instruccion,
            'status' => $this->status,
        ];
    }
}
