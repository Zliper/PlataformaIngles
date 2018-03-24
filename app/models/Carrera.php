<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
	public $timestamps = false;
	protected $fillable = ['nombre_carrera'];
    protected $table = 'carreras';

    public function hasGrupo() {
    	return $this->belongsToMany('App\models\Grupo','grupo_has_carrera','carrera_id','grupo_id');
    }
}
