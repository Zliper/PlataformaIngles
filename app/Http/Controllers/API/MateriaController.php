<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\collections\MateriaCollection;
use App\Http\Resources\MateriaResource;
use App\models\Materia;


class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('year','')) {
            return new MateriaCollection(Materia::where('year','=',$request->input('year'))->get());
        } else if ($request->input('years', '')) {
            return response()->json([Materia::distinct()->select('year')->get()]);
        }

        return new MateriaCollection(Materia::orderBy('year','DESC')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MateriaResource::withoutWrapping();

        $materia = Materia::create($request->all());

        return response(new MateriaResource($materia), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Materia $materia)
    {
        MateriaResource::withoutWrapping();
        return new MateriaResource($materia);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materia $materia)
    {
        MateriaResource::withoutWrapping();
        $materia->update($request->all());

        return response(new MateriaResource($materia), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materia $materia)
    {
        $materia->delete();

        return response()->json(null, 204);
    }
}
