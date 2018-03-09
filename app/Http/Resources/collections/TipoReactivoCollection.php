<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TipoReactivoCollection extends ResourceCollection
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
            "tipos" => $this->collection->transform(function($t) {
                return [
                    'id' => $t->id,
                    'tipo' => $t->tipo_reactivo,
                ];
            })
        ];
    }
}
