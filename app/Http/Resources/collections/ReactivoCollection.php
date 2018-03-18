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
                    'attributes' => [
                        'pregunta' => $reactivo->pregunta, 
                        'respuesta' => $reactivo->respuesta_correcta,
                        'texto' => $reactivo->texto,
                    ],
                    'relationships' => [
                        "opciones" => new OpcionReactivosCollection($reactivo->opciones),
                        "competencia" => new CompetenciaResource($reactivo->competencia),
                        "tipo_reactivo" => new TipoReactivoResource($reactivo->tipo),
                        "estatus_reactivo" => new EstatusResource($reactivo->estatus),
                        "autor" => new ProfesorResource($reactivo->profesor),
                    ],
                ];
            }),
        ];
    }
}
