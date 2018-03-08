<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReactivoCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function($reactivo){
                return [
                    'id' => $reactivo->id,
                    'pregunta' => $reactivo->pregunta,
                ];
            }),
        ];
    }
}
