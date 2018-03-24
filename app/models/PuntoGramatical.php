<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PuntoGramatical extends Model
{
	public $timestamps = false;
	protected $fillable = ['unidad','punto_gramatica','materia_id'];
    protected $table = 'puntos_gramaticales';

    public function materia() {
    	return $this->belongsTo('App\models\Materia','materia_id');
    }
}
