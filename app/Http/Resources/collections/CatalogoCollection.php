<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CatalogoCollection extends ResourceCollection
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
            "catalogo" => $this->collection->transform(function ($c) {
                return [
                    "id" => $c->id,
                    "tipo" => $c->tipo_cuestionario
                ];
            })
        ];
    }
}
