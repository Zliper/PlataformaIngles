<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    public $timestamps = false;
	protected $fillable = [
		'materia_id','catalogo_id','alumno_id','cantidad_reactivos',
		'nota','instruccion','status',
	];
    
    protected $table = 'evaluaciones';

    public function alumno() {
    	return $this->belongsTo('App\models\Alumno','alumno_id','matricula');
    }

    public function materia() {
    	return $this->belongsTo('App\models\Materia','materia_id','id');
    }

    public function catalogo() {
    	return $this->belongsTo('App\models\CatalogoCuestionario','catalogo_id','id');
    }
}
