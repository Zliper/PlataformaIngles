<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EstatusCollection extends ResourceCollection
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
            "estatus" => $this->collection->transform(function($e) {
                return [
                    'id' => $e->id,
                    'estatus' => $e->estatus,
                ];
            })
        ];
    }
}
