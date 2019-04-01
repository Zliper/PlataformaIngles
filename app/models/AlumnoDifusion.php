<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AlumnoDifusion extends Model
{
    public $timestamps = false;
	protected $fillable = ['matricula','difusion_id','readingGuardadas','listeningGuardadas','writingGuardadas','readingCorrectas','listeningCorrectas','writingCorrectas','status'];
    protected $table = 'alumno_has_difusion';
    protected $primaryKey = 'id';

    public function hasDifusion() {
        return $this->belongsTo('App\models\Difusion','difusion_id','id');
    }
}
