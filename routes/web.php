<?php

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function() {
	return view('coordinador');
});


Route::get('/maestro', function () {
	return view('maestro');
});