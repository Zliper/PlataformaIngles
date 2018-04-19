<?php

//Vista coordinador
Route::get('/coordinador', function() {
	return view('coordinador');
});

//vista maestro
Route::get('/maestro', function () {
	return view('maestro');
});

//vista alumno
Route::get('/alumno', function() {
	return view('alumno');
});