<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\ComentarioResource;

class ComentarioCollection extends ResourceCollection
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
            "comentarios" => $this->collection->transform(function($c) {
                return [
                    'id' => $c->id,
                    'reactivo_id' => new ReactivoResource($c->hasReactivo),
                    'comentario' => $c->comentario,
                ];
            })
        ];
    }
}