<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CatalogoCuestionario extends Model
{
	public $timestamps = false;
	protected $fillable = ['tipo_cuestionario'];
    protected $table = 'catalogo_cuestionarios';

    public function hasEvaluacion() {
    	return $this->hasMany('App\models\Evaluacion','catalogo_id');
    }
}
