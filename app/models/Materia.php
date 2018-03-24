<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    public $timestamps = false;
	protected $fillable = ['materia','periodo','year'];
    protected $table = 'materias';

    public function has_grupo() {
    	return $this->belongsToMany('App\models\Grupo','grupo_has_materia','materia_id','grupo_id');
    }

    public function puntos() {
    	return $this->hasMany('App\models\PuntoGramatical','materia_id');
    }

    public function evaluaciones() {
    	return $this->hasMany('App\models\Evaluacion','materia_id');
    }
}
