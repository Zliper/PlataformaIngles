<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public $timestamps = false;
    protected $fillable = ['reactivo_id','comentario'];
    protected $table = 'comentarios';
    protected $primaryKey = 'id';

    public function hasReactivo() {
        return $this->belongsTo('App\models\Reactivo','reactivo_id','id');
    }
}
