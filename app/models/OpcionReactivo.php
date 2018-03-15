<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class OpcionReactivo extends Model
{
	protected $fillable = ['reactivo_id','opcion'];
    protected $table = 'opcion_reactivos';
    
    public function reactivos() {
    	return $this->belongsTo('App\models\Reactivo','reactivo_id');
    }
}
