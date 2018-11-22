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
            "difusiones" => $this->collection->transform(function($p) {
                return [
                    'id' => $p->id,
                    'evaluacion_id' => new EvaluacionResource($p->nota),
                    'profesor_id' => $p->profesor_id,
                    'matricula' => $p->matricula,
                    'duracion' => $p->duracion,
                    'fecha_creacion' => $p->fecha_creacion,
                    'fecha_aplicacion' => $p->fecha_aplicacion,
                    'status' => $p->status,
                    /*'relationships' => [
                        "punto_gramatical" => new PuntoGramaticalResource($p->punto_gramatical),
                    ],*/
                ];
            })
        ];
    }
}