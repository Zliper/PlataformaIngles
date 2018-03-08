<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
	protected $fillable = ['nombre','apellido'];
    protected $table = 'profesores';

    public function hasRolUsuario() {
    	return $this->belongsToMany('App\models\RolUsuario','profesor_has_rol','profesor_id','rol_id');
    }

    public function hasGrupo() {
    	return $this->belongsToMany('App\models\Grupo','grupo_has_profesor','profesor_id','grupo_id');
    }
}
