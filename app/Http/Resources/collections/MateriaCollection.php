<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MateriaCollection extends ResourceCollection
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
            "materias" => $this->collection->transform(function($m) {
                return [
                    'id' => $m->id,
                    'materia' => $m->materia,
                    'periodo' => $m->periodo,
                    'year' => $m->year
                ];
            })
        ];
    }
}
