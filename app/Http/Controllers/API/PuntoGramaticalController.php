<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\PuntoGramatical;
use App\Http\Resources\PuntoGramaticalResource;
use App\Http\Resources\collections\PuntoGramaticalCollection;

class PuntoGramaticalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('year','')) {
            $year = $request->input('year');
            $puntos = PuntoGramatical::join('materias', function($join) use ($year){
                $join->on('puntos_gramaticales.materia_id','=','materias.id')
                    ->where('materias.year','=',$year);
            })
            ->get();
            
            return $puntos;
        } else if ($request->input('materia','')) {
            $materia = $request->input('materia');
            echo($materia);
            $puntos = PuntoGramatical::join('materias', function($join) use ($materia){
                $join->on('puntos_gramaticales.materia_id','=','materias.id')
                    ->where('materias.id','=',$materia);
            })
                ->get();
            return $puntos;
        }
        return new PuntoGramaticalCollection(PuntoGramatical::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        PuntoGramaticalResource::withoutWrapping();
        $punto = PuntoGramatical::create($request->all());
        return response(new PuntoGramaticalResource($punto), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PuntoGramatical $punto)
    {
        PuntoGramaticalResource::withoutWrapping();
        return new PuntoGramaticalResource($punto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PuntoGramatical $punto)
    {
        PuntoGramaticalResource::withoutWrapping();
        $punto->update($request->all());
        return response(new PuntoGramaticalResource($punto), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PuntoGramatical $punto)
    {
        $punto->delete();

        return response()->json(null, 204);
    }
}
