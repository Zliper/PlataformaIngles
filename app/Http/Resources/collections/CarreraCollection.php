<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CarreraCollection extends ResourceCollection
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
            "carreras" => $this->collection->transform(function($c) {
                return [
                    'id' => $c->id,
                    'carrera' => $c->nombre_carrera,
                ];
            })
        ];
    }
}
