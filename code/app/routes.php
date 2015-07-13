<?php

Route::get('/', function () {
	return View::make('errors')->withCode('500');
});

// SHORTEN ROUTES
Route::get('{shorten}', 'ShortenController@getShorten');
Route::group(array('prefix' => 'shorten'), function () {
	Route::post('/', 'ShortenController@postShorten');
	Route::get('generate', 'ShortenController@index');
});

// SURVEY ROUTES
Route::group(array('prefix' => 'survey'), function () {
	Route::get('{idcliente}/{canal}', 'EncuestasController@index');
	Route::post('/', 'EncuestasController@store');
	Route::get('politicas', 'PoliticasController@index');
	Route::get('addexception', 'ExcepcionesController@add');
	Route::get('success', 'ApiController@generateMessage');
	Route::get('error', 'ApiController@generateError');
});

//ADMINISTRATOR
Route::group(array('prefix' => 'admin'), function () {
	Route::get('login', 'AdminController@index');
	Route::post('/', 'AdminController@login');
	Route::get('logout', 'AdminController@logout');
	Route::get('cpanel', 'AdminController@cpanel');
});

Route::get('test/test', function () {
	//$clienteApariencia   = Cliente::find(3)->apariencias->first();
	//$encuestaPorCliente  = Cliente::find(4)->sector->encuestas->first()->titulo;
	//$sectorPorCliente    = Cliente::find(1)->sector;
	//$clientesPorSector   = Sector::find(2)->clientes;
	//$preguntasPorCliente = Cliente::find(1)->sector->encuestas->first()->preguntas;
	//
	$out = Cliente::find(10)->plan;
	//
	dd($out);
});