<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
	protected $fillable = ['tipo_rol'];
    protected $table = 'roles';
}
