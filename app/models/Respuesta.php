<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
	public $timestamps = false;
	protected $fillable = ['evaluacion_id','reactivo_id'];
    protected $table = 'respuestas';
    
}
