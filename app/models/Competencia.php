<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
	public $timestamps = false;
	protected $fillable = ['tipo_competencia'];
    protected $table = 'competencias';

    public function hasReactivo() {
    	return $this->hasMany('App\models\Reactivo','competencia_id');
    }
}
