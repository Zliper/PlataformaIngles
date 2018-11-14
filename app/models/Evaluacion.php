<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{

    public $timestamps = false;
	protected $fillable = [
		'profesor_id','materia_id','catalogo_id','alumno_id', 'punto_gramatical', 'cantidad_reading','cantidad_listening','cantidad_writing',
		'nota','instruccion','status','fecha_creacion',
	];
    
    protected $table = 'evaluaciones';
    protected $primaryKey = 'id';

    public function profesor() {
    	return $this->belongsTo('App\models\Profesor','profesor_id','id');
    }
    
    public function alumno() {
    	return $this->belongsTo('App\models\Alumno','alumno_id','matricula');
    }

    public function materia() {
    	return $this->belongsTo('App\models\Materia','materia_id','id');
    }

    public function catalogo() {
    	return $this->belongsTo('App\models\CatalogoCuestionario','catalogo_id','id');
    }

    public function punto_gramatical() {
    	return $this->belongsTo('App\models\PuntoGramatical','punto_gramatical','id');
    }
}
