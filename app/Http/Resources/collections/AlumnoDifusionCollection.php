<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\DifusionResource;

class AlumnoDifusionCollection extends ResourceCollection
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
            "alumnoDifusiones" => $this->collection->transform(function($ad) {
                return [
                    'matricula' => $ad->matricula,
                    'difusion_id' => new DifusionResource($ad->hasDifusion),
                    'guardadas' => $ad->guardadas,
                    'status' => $ad->status,
                ];
            })
        ];
    }
}