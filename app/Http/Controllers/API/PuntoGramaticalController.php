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
    public function index()
    {
        return new PuntoGramaticalCollection(PuntoGramatical::all());
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
