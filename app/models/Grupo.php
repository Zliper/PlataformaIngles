<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
	protected $fillable = ['grupo','periodo'];
    protected $table = 'grupos';


    public function hasCarrera() {
    	return $this->belongsToMany('App\models\Carrera','grupo_has_carrera','grupo_id','carrera_id');
    }

    public function hasMateria() {
    	return $this->belongsToMany('App\models\Materia','grupo_has_materia','grupo_id','materia_id');
    }
}
