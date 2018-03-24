<?php

use Illuminate\Http\Request;

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');


Route::resource('reactivos','API\ReactivoController');
Route::resource('carreras','API\CarreraController');
Route::resource('materias','API\MateriaController');
Route::resource('puntos','API\PuntoGramaticalController');
Route::resource('grupos', 'API\GrupoController');

Route::get('estatus','API\EstatusController@index');
Route::get('competencias','API\CompetenciaController@index');
Route::get('tipos','API\TipoReactivoController@index');


Route::group(['middleware' => 'auth:api'], function() {
});