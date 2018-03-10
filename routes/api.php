<?php

use Illuminate\Http\Request;

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth:api'], function() {
	Route::resource('reactivos','API\ReactivoController');
	Route::resource('carreras','API\CarreraController');
	Route::resource('materias','API\MateriaController');
	Route::resource('puntos','API\PuntoGramaticalController');
	Route::resource('grupos', 'API\GrupoController');

	Route::get('estatus','API\EstatusController@index');
	Route::get('competencias','API\CompetenciaController@index');
	Route::get('tipos','API\TipoReactivoController@index');
});