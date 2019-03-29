<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Difusion extends Model
{

    public $timestamps = false;
	protected $fillable = [
		'evaluacion_id','profesor_id','duracion','fecha_creacion', 'fecha_aplicacion', 'fecha_limite', 'status'
	];
    
    protected $table = 'difusiones';
    protected $primaryKey = 'id';

    public function evaluacion() {
    	return $this->belongsTo('App\models\Evaluacion','evaluacion_id','id');
    }
}