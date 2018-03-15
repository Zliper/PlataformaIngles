<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Reactivo extends Model
{
	protected $fillable = [
		'competencia_id','tipo_id','estatus_id','profesor_id','pregunta',
		'respuesta_correcta','texto',
	];

    protected $table = 'reactivos';

    public function competencia() {
    	return $this->belongsTo('App\models\Competencia','competencia_id');
    }

    public function tipo() {
    	return $this->belongsTo('App\models\TipoReactivo','tipo_id');
    }

    public function estatus() {
    	return $this->belongsTo('App\models\estatus','estatus_id');
    }

    public function profesor() {
    	return $this->belongsTo('App\models\Profesor','profesor_id');
    }

    public function opciones() {
        return $this->hasMany('App\models\OpcionReactivo', 'reactivo_id');
    }
}
