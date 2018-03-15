<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;


class OpcionReactivosCollection extends ResourceCollection
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
            'opciones' => $this->collection->transform(function($opcion) {
                return [
                    'opcion' => $opcion->opcion,
                ];
            })
        ];
    }
}
