<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\collections\CatalogoCollection;
use App\models\CatalogoCuestionario;

class CatalogoCuestionarioController extends Controller
{
    public function index() {
    	return new CatalogoCollection(CatalogoCuestionario::all());
    }
}
