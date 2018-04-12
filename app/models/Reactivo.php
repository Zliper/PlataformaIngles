<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Reactivo extends Model
{
    public $timestamps = false;
	protected $fillable = [
		'competencia_id','tipo_id','estatus_id','profesor_id','text_id',
        'punto_id','catalogo_id','pregunta','respuesta_correcta',
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

    public function text() {
      return $this->belongsTo('App\models\Text', 'text_id');
    }

    public function punto() {
      return $this->belongsTo('App\models\PuntoGramatical', 'punto_id');
    }

    public function catalogo() {
      return $this->belongsTo('App\models\CatalogoCuestionario','catalogo_id');
    }
}
