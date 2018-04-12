<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    public $timestamps = false;

    protected $fillable = ['text'];

    protected $table = 'text';
}
