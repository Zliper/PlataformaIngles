<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\collections\CompetenciaCollection;
use App\models\Competencia;


class CompetenciaController extends Controller
{
    public function index() {
    	return new CompetenciaCollection(Competencia::all());
    }
}
