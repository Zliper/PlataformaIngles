<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\ProfesorResource;
use App\Http\Resources\MateriaResource;
use App\Http\Resources\CatalagoResource;
use App\Http\Resources\PuntoGramaticalResource;

class EvaluacionCollection extends ResourceCollection
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
            "evaluaciones" => $this->collection->transform(function($p) {
                return [
                    'id' => $p->id,
                    'profesor_id' => $p->profesor_id,
                    'materia' => new MateriaResource($p->materia),
                    'tipo' => new CatalagoResource($p->catalogo),
                    "punto_gramatical" => new PuntoGramaticalResource($p->puntogramatical),
                    'cantidad_reading' => $p->cantidad_reading,
                    'cantidad_listening' => $p->cantidad_listening,
                    'cantidad_writing' => $p->cantidad_writing,
                    'nota' => $p->nota,
                    'instruccion' => $p->instruccion,
                    'status' => $p->status,
                    'fecha_creacion' => $p->fecha_creacion,
                ];
            })
        ];
    }
}