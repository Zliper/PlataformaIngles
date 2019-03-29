<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlumnoDifusionResource extends JsonResource
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
            'matricula' => $this->matricula,
            'difusion_id' => $this->difusion_id,
            'guardadas' => $this->guardadas,
            'status' => $this->status,
        ];
    }
}
