<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\CompetenciaResource;
use App\Http\Resources\TipoReactivoResource;
use App\Http\Resources\EstatusResource;
use App\Http\Resources\ProfesorResource;

use App\Http\Resources\collections\OpcionReactivosCollection;

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
            'reactivos' => $this->collection->transform(function($reactivo){
                return [
                    'id' => $reactivo->id,
                    'pregunta' => $reactivo->pregunta, 
                    'respuesta' => $reactivo->respuesta_correcta,
                    'texto' => $reactivo->texto,
                    'relationships' => [
                        new OpcionReactivosCollection($reactivo->opciones),
                        new CompetenciaResource($reactivo->competencia),
                        new TipoReactivoResource($reactivo->tipo),
                        new EstatusResource($reactivo->estatus),
                        new ProfesorResource($reactivo->profesor),
                    ],
                ];
            }),
        ];
    }
}
