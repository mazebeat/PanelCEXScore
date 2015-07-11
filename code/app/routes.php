<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// SHORTEN ROUTES
Route::get('{shorten}', 'ShortenController@getShorten');
Route::post('shorten', 'ShortenController@postShorten');
Route::get('shorten/generate', 'ShortenController@index');


// SURVEY ROUTES
Route::get('survey/{idcliente}/{canal}', 'EncuestasController@index');
//Route::post('survey', 'EncuestasController@store');
//
//ADMINISTRATOR
//Route::get('admin', 'AdminController@index');
//Route::post('admin', 'AdminController@login');
//Route::get('admin/logout', 'AdminController@logout');

// OTHERS ROUTES
//Route::get('politicas', 'PoliticasController@index');
//Route::get('addexception', 'ExcepcionesController@add');

//Route::get('test', function () {
//	$clienteApariencia   = Cliente::find(3)->apariencias->first();
//	$encuestaPorCliente  = Cliente::find(4)->sector->encuestas->first()->titulo;
//	$sectorPorCliente    = Cliente::find(1)->sector;
//	$clientesPorSector   = Sector::find(2)->clientes;
//	$preguntasPorCliente = Cliente::find(1)->sector->encuestas->first()->preguntas;
//
//	$out = Encuesta::find(1)->preguntas;
//
//	dd($out);
//});

Route::get('survey/error', function () {
	var_dump('ERROR');
});

//Route::get('/ref', function () {
//	$c = Cliente::find(2);
//
//	dd($c->respuestas()->attach(1, array('ultima_respuesta' => Carbon::now())));
//
//	$respuesta = new Respuesta(array('fecha'                => Carbon::now(),
//	                                 'id_estado'            => 1,
//	                                 'id_canal'             => 1,
//	                                 'id_encuesta'          => 1,
//	                                 'id_pregunta_cabecera' => 1,
//	                                 'id_pregunta_detalle'  => 2,
//	                                 'id_tipo_respuesta'));
//
//	Cliente::find(1)->preguntas()->save($role, array('expires' => $expires));
//
//});

Route::get('/', function(){
	echo 'home';
});

//Route::get('{a}', function($a) {
//	echo $a;
//});
//
//Route::get('{a}/{b}', function($a, $b) {
//	echo $a . ' ' . $b;
//});
