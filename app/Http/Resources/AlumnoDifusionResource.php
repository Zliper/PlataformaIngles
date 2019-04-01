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
            'id' => $this->id,
            'matricula' => $this->matricula,
            'difusion_id' => $this->difusion_id,
            'readingGuardadas' => $this->readingGuardadas,
            'listeningGuardadas' => $this->listeningGuardadas,
            'writingGuardadas' => $this->writingGuardadas,
            'readingCorrectas' => $this->readingCorrectas,
            'listeningCorrectas' => $this->listeningCorrectas,
            'writingCorrectas' => $this->writingCorrectas,
            'status' => $this->status,
        ];
    }
}
