<?php

namespace App\Http\Resources\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\CompetenciaResource;
use App\Http\Resources\TipoReactivoResource;
use App\Http\Resources\EstatusResource;
use App\Http\Resources\ComentarioResource;
use App\Http\Resources\ProfesorResource;
use App\Http\Resources\PuntoGramaticalResource;
use App\Http\Resources\CatalagoResource;
use App\Http\Resources\TextResource;
use App\Http\Resources\MateriaResource;


use App\Http\Resources\collections\OpcionReactivosCollection;
use App\Http\Resources\collections\PuntoGramaticalCollection;
use App\Http\Resources\collections\CatalogoCollection;
use App\Http\Resources\collections\ComentarioCollection;


class ReactivoComentarioCollection extends ResourceCollection
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
                    ],
                    'relationships' => [
                        "opciones" => new OpcionReactivosCollection($reactivo->opciones),
                        "competencia" => new CompetenciaResource($reactivo->competencia),
                        "nivel" => new MateriaResource($reactivo->punto->materia),
                        "tipo_reactivo" => new TipoReactivoResource($reactivo->tipo),
                        "estatus_reactivo" => new EstatusResource($reactivo->estatus),
                        "comentario" => new ComentarioResource($reactivo->comentario),
                        "punto_gramatical" => new PuntoGramaticalResource($reactivo->punto),
                        "catalogo" => new CatalagoResource($reactivo->catalogo),
                        "autor" => new ProfesorResource($reactivo->profesor),
                        "text" => new TextResource($reactivo->text),
                    ],
                ];
            }),
        ];
    }
}
