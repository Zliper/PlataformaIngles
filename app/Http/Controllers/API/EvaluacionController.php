<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EvaluacionResource;
use App\Http\Resources\collections\EvaluacionCollection;
use App\models\Evaluacion;

class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('byTipo','')) {
            return new EvaluacionCollection(Evaluacion::where('profesor_id','=',1)->where('catalogo_id','=',$request->input('byTipo',''))->get());
        }
        return new EvaluacionCollection(Evaluacion::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        EvaluacionResource::withoutWrapping();
        $cuestionario = Evaluacion::create($request->all());
        return response(new EvaluacionResource($cuestionario), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluacion $cuestionario)
    {
        EvaluacionResource::withoutWrapping();
        return new EvaluacionResource($cuestionario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluacion $cuestionario)
    {
        EvaluacionResource::withoutWrapping();
        $cuestionario->update($request->all());
        return response(new EvaluacionResource($cuestionario), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluacion $cuestionario)
    {
        $cuestionario->delete();

        return response()->json(null, 204);
    }
}