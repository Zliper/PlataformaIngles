<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DifusionResource;
use App\Http\Resources\collections\DifusionCollection;
use App\models\Difusion;
use App\User;
use Carbon\Carbon;
class DifusionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('byProfesor')) {
            return new DifusionCollection(Difusion::where('profesor_id','=',$request->input('byProfesor'))->get());
        }  else if ($request->input('byStatus')) {
            if ($request->input('matricula')) {
                return new DifusionCollection(Difusion::where('matricula','=',$request->input('matricula'))->where('status','=',$request->input('byStatus'))->get());
            } else if ($request->input('profesor_id')) {
                return new DifusionCollection(Difusion::where('profesor_id','=',$request->input('profesor_id'))->where('status','=',$request->input('byStatus'))->get());
            }
            return new DifusionCollection(Difusion::where('status','=',$request->input('byStatus'))->get());
        } else if ($request->input('count')) {
            if($request->input('count')=='actividades') $tipo = '4';
            if($request->input('count')=='ordinarios') $tipo = '3';
            if($request->input('count')=='recuperaciones') $tipo = '2';
            if($request->input('count')=='extraordinarios') $tipo = '1';
            $matricula = $request->input('matricula');
            $status = $request->input('status');
            $difusiones = Difusion::join('evaluaciones', function($join) use ($tipo,$matricula,$status){
                $join->on('difusiones.evaluacion_id','=','evaluaciones.id')
                ->where('difusiones.matricula','=',$matricula)->where('evaluaciones.catalogo_id','=',$tipo)->where('difusiones.status','=',$status);
            })
                ->count();
            return $difusiones;
        } else if ($request->input('getByAlumno')) {
            if($request->input('getByAlumno')=='actividades') $tipo = '4';
            if($request->input('getByAlumno')=='ordinarios') $tipo = '3';
            if($request->input('getByAlumno')=='recuperaciones') $tipo = '2';
            if($request->input('getByAlumno')=='extraordinarios') $tipo = '1';
            $matricula = $request->input('matricula');
            $status = $request->input('status');
            $difusiones = Difusion::join('evaluaciones', function($join) use ($tipo,$matricula,$status){
                $join->on('difusiones.evaluacion_id','=','evaluaciones.id')
                ->where('difusiones.matricula','=',$matricula)->where('evaluaciones.catalogo_id','=',$tipo)->where('difusiones.status','=',$status);
            })
                ->get();
            return $difusiones;
        } else if ($request->input('getActiveByAlumno')) {
            if($request->input('getActiveByAlumno')=='actividades') $tipo = '4';
            if($request->input('getActiveByAlumno')=='ordinarios') $tipo = '3';
            if($request->input('getActiveByAlumno')=='recuperaciones') $tipo = '2';
            if($request->input('getActiveByAlumno')=='extraordinarios') $tipo = '1';
            $matricula = $request->input('matricula');
            $status = $request->input('status');
            date_default_timezone_set('America/Mexico_City');
            $minutes = 10;
            $fecha = date('Y-m-d H:i:s', strtotime("-$minutes minutes"));
            $difusiones = Difusion::join('evaluaciones', function($join) use ($tipo,$matricula,$status,$fecha){
                $join->on('difusiones.evaluacion_id','=','evaluaciones.id')
                ->where('difusiones.matricula','=',$matricula)->where('evaluaciones.catalogo_id','=',$tipo)->where('difusiones.status','=',$status)->where('fecha_aplicacion', '<=',$fecha)->where('fecha_limite', '>=',$fecha);
            })
                ->get();
            return $difusiones;
        } else if ($request->input('getActiveByProfesor')) {
            if($request->input('tipo')=='actividades') $tipo = '4';
            if($request->input('tipo')=='ordinarios') $tipo = '3';
            if($request->input('tipo')=='recuperaciones') $tipo = '2';
            if($request->input('tipo')=='extraordinarios') $tipo = '1';
            $id = $request->input('getActiveByProfesor');
            $status = $request->input('status');
            date_default_timezone_set('America/Mexico_City');
            $minutes = 6;
            $fecha = date('Y-m-d H:i:s');
            return new DifusionCollection(Difusion::where('profesor_id','=',$id)->whereHas("evaluacion",function($c) use ($tipo){$c->where('catalogo_id','=',$tipo);})->where('status','=',$status)->where('fecha_aplicacion', '<=',$fecha)->where('fecha_limite', '>=',$fecha)->get());
        } else if ($request->input('getPastByProfesor')) {
            if($request->input('tipo')=='actividades') $tipo = '4';
            if($request->input('tipo')=='ordinarios') $tipo = '3';
            if($request->input('tipo')=='recuperaciones') $tipo = '2';
            if($request->input('tipo')=='extraordinarios') $tipo = '1';
            $id = $request->input('getPastByProfesor');
            $status = $request->input('status');
            date_default_timezone_set('America/Mexico_City');
            $minutes = 6;
            $fecha = date('Y-m-d H:i:s');
            return new DifusionCollection(Difusion::where('profesor_id','=',$id)->whereHas("evaluacion",function($c) use ($tipo){$c->where('catalogo_id','=',$tipo);})->where('status','=',$status)->where('fecha_aplicacion', '<=',$fecha)->where('fecha_limite', '<=',$fecha)->get());
        } else if ($request->input('getNextByProfesor')) {
            if($request->input('tipo')=='actividades') $tipo = '4';
            if($request->input('tipo')=='ordinarios') $tipo = '3';
            if($request->input('tipo')=='recuperaciones') $tipo = '2';
            if($request->input('tipo')=='extraordinarios') $tipo = '1';
            $id = $request->input('getNextByProfesor');
            $status = $request->input('status');
            date_default_timezone_set('America/Mexico_City');
            $minutes = 6;
            $fecha = date('Y-m-d H:i:s');
            return new DifusionCollection(Difusion::where('profesor_id','=',$id)->whereHas("evaluacion",function($c) use ($tipo){$c->where('catalogo_id','=',$tipo);})->where('status','=',$status)->where('fecha_aplicacion', '>=',$fecha)->where('fecha_limite', '>=',$fecha)->get());
        } else if ($request->input('countActiveByAlumno')) {
            if($request->input('countActiveByAlumno')=='actividades') $tipo = '4';
            if($request->input('countActiveByAlumno')=='ordinarios') $tipo = '3';
            if($request->input('countActiveByAlumno')=='recuperaciones') $tipo = '2';
            if($request->input('countActiveByAlumno')=='extraordinarios') $tipo = '1';
            $matricula = $request->input('matricula');
            $status = $request->input('status');
            date_default_timezone_set('America/Mexico_City');
            $minutes = 6;
            $fecha = date('Y-m-d H:i:s', strtotime('-10 minutes'));
            $difusiones = Difusion::join('evaluaciones', function($join) use ($tipo,$matricula,$status,$fecha){
                $join->on('difusiones.evaluacion_id','=','evaluaciones.id')
                ->where('difusiones.matricula','=',$matricula)->where('evaluaciones.catalogo_id','=',$tipo)->where('difusiones.status','=',$status)->where('fecha_aplicacion', '>=',$fecha);
            })
                ->count();
            return $difusiones;
        } else if ($request->input('all')) {
            return new DifusionCollection(Difusion::get());
        }
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
        $id = new DifusionResource($difusion);
        return response()->json(['success' => $id], 200);
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