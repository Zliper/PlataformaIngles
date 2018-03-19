<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GrupoResource;
use App\Http\Resources\collections\GrupoCollection;
use App\models\Carrera;
use App\models\Grupo;
use App\models\Materia;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new GrupoCollection(Grupo::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $materia = Materia::findOrFail($request->materia);
        $carrera = Carrera::findOrFail($request->carrera);

        $grupo = Grupo::create([
            "grupo" => $request->grupo
        ]);

        $grupo->hasMateria()->attach($materia);
        $grupo->hasCarrera()->attach($carrera);

        return response( new GrupoResource($grupo), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        GrupoResource::withoutWrapping();
        return new GrupoResource($grupo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupo $grupo)
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
    public function update(Request $request, Grupo $grupo)
    {
        GrupoResource::withoutWrapping();
        $grupo->update($request->all());
        return response(new GrupoResource($grupo), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupo $grupo)
    {
        $grupo->delete();

        return response()->json(null, 204);
    }
}
