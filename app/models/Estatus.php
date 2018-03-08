<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
	protected $fillable = ['estatus'];
    protected $table = 'estatus';


    public function hasReactivo() {
    	return $this->hasMany('App\models\Reactivo','estatus_id');
    }
}
