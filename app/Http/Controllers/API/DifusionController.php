<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DifusionResource;
use App\Http\Resources\collections\DifusionCollection;
use App\models\Difusion;
use App\User;
class DifusionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('byProfesor','')) {
            return new DifusionCollection(Difusion::where('profesor_id','=',$request->input('byProfesor',''))->get());
        } /*else if($request->input('count','') == "Actividades") {
            return Evaluacion::where('alumno_id','=',1)->where('catalogo_id',4)->count();
        } else if($request->input('count','') == "Examenes") {
            return Evaluacion::where('alumno_id','=',1)->where('catalogo_id',1)->count();
        }*/
        return new DifusionCollection(Difusion::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        DifusionResource::withoutWrapping();
        $difusion = Difusion::create($request->all());
        return response(new DifusionResource($difusion), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Difusion $difusion)
    {
        DifusionResource::withoutWrapping();
        return new DifusionResource($difusion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        // EvaluacionResource::withoutWrapping();
        // $cuestionario->update($request->all());
        // return response(new EvaluacionResource($cuestionario), 200);
        $difusion = Difusion::findOrFail($id);
        //return response()->json(null,204);
        //return Evaluacion::find($id)->nota;
        if($difusion->update($request->all())){
            return response()->json(null,204);
        }
        //return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($cuestionario);
        $difusion = Difusion::findOrFail($id);
        //return response()->json(null,204);
        //return Evaluacion::find($id)->nota;
        if($difusion->delete()){
            return response()->json(null,204);
        }
    }

}