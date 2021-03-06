<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\collections\ReactivoCollection;
use App\Http\Resources\collections\ReactivoComentarioCollection;
use App\Http\Resources\ReactivoResource;
use App\models\Reactivo;
use App\models\OpcionReactivo;
use App\models\Competencia;

class ReactivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        if ($request->input('by','') == "Aprobado") {
            if ($request->input('profesor_id')){
                return new ReactivoCollection(Reactivo::where('estatus_id','=',1)->where('profesor_id','=',$request->input('profesor_id'))->paginate(3));
            } else {
                return new ReactivoCollection(Reactivo::where('estatus_id','=',1)->paginate(3));
            }
        } else if ($request->input('by','') == "Espera") {
            if ($request->input('profesor_id')){
                return new ReactivoCollection(Reactivo::where('estatus_id','=',2)->where('profesor_id','=',$request->input('profesor_id'))->paginate(3));
            } else {
                return new ReactivoCollection(Reactivo::where('estatus_id','=',2)->paginate(3));
            }
        } else if ($request->input('by','') == "Comentario") {
            if ($request->input('profesor_id')){
                return new ReactivoComentarioCollection(Reactivo::where('estatus_id','=',3)->where('profesor_id','=',$request->input('profesor_id'))->with('Comentario')->paginate(3));
            } else {
                return new ReactivoCollection(Reactivo::where('estatus_id','=',3)->with('Comentario')->paginate(3));
            }
        } else if($request->input('count','') == "Aprobado") {
            return Reactivo::where('estatus_id',1)->count();
        } else if($request->input('count','') == "Espera") {
            return Reactivo::where('estatus_id',2)->count();
        } else if($request->input('count','') == "Espera") {
            return Reactivo::where('estatus_id',2)->count();
        } else if($request->input('byCompetencia')) {
            if($request->input('byCompetencia')=='reading') $competencia = '1';
            if($request->input('byCompetencia')=='listening') $competencia = '2';
            if($request->input('byCompetencia')=='writing') $competencia = '3';
            $tipo = $request->input('tipo');
            $punto = $request->input('punto');
            return Reactivo::where('estatus_id',1)->where('competencia_id',$competencia)->where('catalogo_id',$tipo)->where('punto_id',$punto)->with('Opciones')->with('Competencia')->with('Text')->get();
        } else if($request->input('byCompetenciaRandom')) {
            if($request->input('byCompetenciaRandom')=='reading') $competencia = '1';
            if($request->input('byCompetenciaRandom')=='listening') $competencia = '2';
            if($request->input('byCompetenciaRandom')=='writing') $competencia = '3';
            $tipo = $request->input('tipo');
            $punto = $request->input('punto');
            return Reactivo::inRandomOrder()->where('estatus_id',1)->where('competencia_id',$competencia)->where('catalogo_id',$tipo)->where('punto_id',$punto)->with('Opciones')->with('Competencia')->with('Text')->first();
        } else {
            return new ReactivoCollection(Reactivo::where('profesor_id','=',$request->input('by',''))->with('Comentario')->paginate(3));
        }

        return new ReactivoCollection(Reactivo::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reactivo = Reactivo::create([
            "competencia_id" => $request->competencia_id,
            "tipo_id" => $request->tipo_id,
            "estatus_id" => $request->estatus_id,
            "profesor_id" => $request->profesor_id,
            "text_id" => $request->text_id,
            "punto_id" => $request->punto_id,
            "catalogo_id" => $request->catalogo_id,
            "pregunta" => $request->pregunta,
            "respuesta_correcta" => $request->respuesta_correcta
        ]);

        foreach ($request->opciones as $o) {
            $o = OpcionReactivo::create([
                "reactivo_id" => $reactivo->id,
                "opcion" => $o
            ]);
        }

        return response(new ReactivoResource($reactivo),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reactivo $reactivo)
    {
        ReactivoResource::withoutWrapping();
        return new ReactivoResource($reactivo);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reactivo $reactivo)
    {
        $reactivo->update($request->all());

        return response(new ReactivoResource($reactivo), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reactivo $reactivo)
    {
        $reactivo->delete();
        return response()->json(null,204);
    }

    public function upload(Request $request)
    {
        info('This is some useful information.');
        if(count($request->images)) {
            foreach ($request->images as $image) {
                
                $image->store('images');    
            }
        }
        
        return response()->json([
            "message" => "Done"
        ]);
    }   
}
