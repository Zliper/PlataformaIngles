<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PuntoGramatical extends Model
{
	protected $fillable = ['unidad','punto_gramatical'];
    protected $table = 'puntos_gramaticales';

    public function materia() {
    	return $this->belongsTo('App\models\Materia','materia_id');
    }
}
