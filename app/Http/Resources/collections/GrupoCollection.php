<?php

namespace App\Http\Resources\collections;

use App\Http\Resources\collections\CarreraCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GrupoCollection extends ResourceCollection
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
            'grupos' =>  $this->collection->transform(function($g) {
                return [
                    'id' => $g->id,
                    'grupo' => $g->grupo,
                    "relationships" => [
                        "materias" => new MateriaCollection($g->hasMateria),
                        "carreras" => new CarreraCollection($g->hasCarrera)
                    ]
                ];
            })
        ];
    }
}
