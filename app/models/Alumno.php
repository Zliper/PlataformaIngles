<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
	public $timestamps = false;
	protected $fillable = ['nombre','apellido'];
    protected $table = 'alumnos';
    protected $primaryKey = 'matricula';

    public function hasGroup() {
    	return $this->belongsToMany('App\models\Grupo','grupo_has_alumno','alumno_id','grupo_id');
    }

    public function hasEvaluacion() {
    	return $this->hasMany('App\models\Evaluacion','alumno_id');
    }
}
