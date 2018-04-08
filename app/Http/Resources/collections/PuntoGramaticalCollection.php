<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\MateriaResource;

class PuntoGramaticalCollection extends ResourceCollection
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
            "puntos_gramaticales" => $this->collection->transform(function($p) {
                return [
                    'id' => $p->id,
                    'unidad' => $p->unidad,
                    'punto_gramatical' => $p->punto_gramatica,
                    'nivel' => new MateriaResource($p->materia)
                ];
            })
        ];
    }
}
