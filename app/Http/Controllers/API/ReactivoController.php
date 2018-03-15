<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\collections\ReactivoCollection;
use App\Http\Resources\ReactivoResource;
use App\models\Reactivo;

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
            return new ReactivoCollection(Reactivo::where('estatus_id','=',1)->paginate(5));
        } else if ($request->input('by','') == "Espera") {
            return new ReactivoCollection(Reactivo::where('estatus_id','=',2)->paginate(5));
        }
        return new ReactivoCollection(Reactivo::paginate(5));
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
        ReactivoResource::withoutWrapping();
        $reactivo = Reactivo::create($request->all());

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
}
