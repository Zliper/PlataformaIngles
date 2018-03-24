<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
	public $timestamps = false;
	protected $fillable = ['tipo_rol'];
    protected $table = 'roles';
}
