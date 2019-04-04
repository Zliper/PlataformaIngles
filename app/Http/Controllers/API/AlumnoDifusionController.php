<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AlumnoDifusionResource;
use App\Http\Resources\collections\AlumnoDifusionCollection;
use App\models\AlumnoDifusion;

class AlumnoDifusionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->input('matriculaByDifusion')) {
            return AlumnoDifusion::where('difusion_id',$request->input('matriculaByDifusion'))->get()->pluck('matricula');
        } else if ($request->input('resultadosByDifusion')) {
            return AlumnoDifusion::where('difusion_id',$request->input('resultadosByDifusion'))->with("hasDifusion")->with('hasDifusion','hasDifusion.evaluacion')->get();
        } else if ($request->input('getActiveByAlumno')) {
            if($request->input('getActiveByAlumno')=='actividades') $tipo = '4';
            if($request->input('getActiveByAlumno')=='ordinarios') $tipo = '3';
            if($request->input('getActiveByAlumno')=='recuperaciones') $tipo = '2';
            if($request->input('getActiveByAlumno')=='extraordinarios') $tipo = '1';
            date_default_timezone_set('America/Mexico_City');
            $fecha = date('Y-m-d H:i:s');
            $matricula = $request->input('matricula');
            $status = $request->input('status');
            /* $difusiones = Difusion::where('difusiones.matricula','=',$matricula)->where('evaluaciones.catalogo_id','=',$tipo)->where('difusiones.status','=',$status)->where('fecha_aplicacion', '<=',$fecha)->where('fecha_limite', '>=',$fecha);
            })->get(); */

            return new AlumnoDifusionCollection(AlumnoDifusion::where('matricula','=',$matricula)->whereHas("hasDifusion",function($c) use ($tipo){$c->whereHas("evaluacion",function($c) use ($tipo){$c->where('catalogo_id','=',$tipo);});})->whereHas("hasDifusion",function($c) use ($status){$c->where('status','=',$status);})->whereHas("hasDifusion",function($c) use ($fecha){$c->where('fecha_aplicacion', '<=',$fecha);})->whereHas("hasDifusion",function($c) use ($fecha){$c->where('fecha_limite', '>=',$fecha);})->where('status','=',$status)->get());
            // return $difusiones;
        } else if ($request->input('countActiveByAlumno')) {
            if($request->input('tipo')=='actividades') $tipo = '4';
            if($request->input('tipo')=='ordinarios') $tipo = '3';
            if($request->input('tipo')=='recuperaciones') $tipo = '2';
            if($request->input('tipo')=='extraordinarios') $tipo = '1';
            date_default_timezone_set('America/Mexico_City');
            $fecha = date('Y-m-d H:i:s');
            $matricula = $request->input('countActiveByAlumno');
            $status = $request->input('status');
            return AlumnoDifusion::where('matricula','=',$matricula)->whereHas("hasDifusion",function($c) use ($tipo){$c->whereHas("evaluacion",function($c) use ($tipo){$c->where('catalogo_id','=',$tipo);});})->whereHas("hasDifusion",function($c) use ($status){$c->where('status','=',$status);})->whereHas("hasDifusion",function($c) use ($fecha){$c->where('fecha_aplicacion', '<=',$fecha);})->whereHas("hasDifusion",function($c) use ($fecha){$c->where('fecha_limite', '>=',$fecha);})->where('status','=',$status)->count();
        } else {
            return new AlumnoDifusionCollection(AlumnoDifusion::get());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AlumnoDifusionResource::withoutWrapping();
        $difusion = AlumnoDifusion::create($request->all());
        return response(new AlumnoDifusionResource($difusion), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $alumnoDifusion = AlumnoDifusion::findOrFail($id);
        //return response()->json(null,204);
        //return Evaluacion::find($id)->nota;
        if($alumnoDifusion->update($request->all())){
            return response()->json(null,204);
        }
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
        //$difusion = AlumnoDifusion::findOrFail($id);
        $difusion = AlumnoDifusion::where('difusion_id',$id);
        //return response()->json(null,204);
        //return Evaluacion::find($id)->nota;
        if($difusion->delete()){
            return response()->json(null,204);
        }
    }
}
