<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\collections\TipoReactivoCollection;
use App\models\TipoReactivo;

class TipoReactivoController extends Controller
{
    public function index() {
    	return new TipoReactivoCollection(TipoReactivo::all());
    }
}
