<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InstruccionCollection extends ResourceCollection
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
            "instrucciones" => $this->collection->transform(function($i) {
                return [
                    "id" => $i->id,
                    "tipo_reactivo_id" => $i->tipo_reactivo_id,
                    "instruccion" => $i->instruccion,
                ];
            })
        ];
    }
}
