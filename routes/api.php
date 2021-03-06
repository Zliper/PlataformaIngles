<?php

// api token  
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
//end 

Route::resource('reactivos','API\ReactivoController');
Route::resource('carreras','API\CarreraController');
Route::resource('materias','API\MateriaController');
Route::resource('puntos','API\PuntoGramaticalController');
Route::resource('evaluaciones','API\EvaluacionController');
Route::resource('difusiones','API\DifusionController');
Route::resource('alumnoDifusiones','API\AlumnoDifusionController');
//Route::resource('delEvaluacion','API\EvaluacionController@destroy');
//Route::resource('grupos', 'API\GrupoController');
Route::resource('texts', 'API\TextController');
Route::resource('comentarios', 'API\ComentarioController');
Route::resource('instrucciones','API\InstruccionController');


Route::get('estatus','API\EstatusController@index');
Route::get('competencias','API\CompetenciaController@index');
Route::get('tipos','API\TipoReactivoController@index');
Route::get('cuestionarios','API\CatalogoCuestionarioController@index');

//Route::delete('delEvaluaciones','API\EvaluacionController@destroy');
Route::post('file-upload','API\ReactivoController@upload');
Route::post('upload', 'FileController@store');

Route::group(['middleware' => 'auth:api'], function() {
	//colocar todas las rutas para login api.
});
