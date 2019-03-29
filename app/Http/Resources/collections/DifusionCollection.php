<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\EvaluacionResource;

class DifusionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "difusiones" => $this->collection->transform(function($d) {
                return [
                    'difusion_id' => $d->id,
                    'evaluacion_id' => new EvaluacionResource($d->evaluacion),
                    'profesor_id' => $d->profesor_id,
                    'duracion' => $d->duracion,
                    'fecha_creacion' => $d->fecha_creacion,
                    'fecha_aplicacion' => $d->fecha_aplicacion,
                    'fecha_limite' => $d->fecha_limite,
                    'status' => $d->status,
                ];
            })
        ];
    }
}