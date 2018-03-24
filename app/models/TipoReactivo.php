<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TipoReactivo extends Model
{
	public $timestamps = false;
	protected $fillable = ['tipo_reactivo'];
    protected $table = 'tipo_reactivos';

    public function reactivos() {
    	return $this->hasMany('App\models\Reactivo','tipo_id');
    }
}
