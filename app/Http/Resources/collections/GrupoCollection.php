<?php

namespace App\Http\Resources\collections;

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
                    'periodo' => $g->periodo,
                    "relationships" => [
                        new MateriaCollection($g->hasMateria)
                    ]
                ];
            })
        ];
    }
}
