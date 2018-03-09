<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\collections\GrupoCollection;

class CarreraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "data" => [

                'id' => $this->id,
                "attributes" => [
                    'carrera' => $this->nombre_carrera,
                ],

                "relationships" => [
                    new GrupoCollection($this->hasGrupo),
                ],
            ]
        ];
    }
}
