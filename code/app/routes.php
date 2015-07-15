<?php

Route::get('/', function () {
	return View::make('survey.errors')->withCode('500');
});

// SHORTEN ROUTES
Route::get('{shorten}', 'ShortenController@getShorten');

// SURVEY ROUTES
Route::group(array('prefix' => 'survey'), function () {
	Route::get('{idcliente}/{canal}/{momento}', 'EncuestasController@index');
	Route::post('store', 'EncuestasController@store');
	Route::get('politicas', 'PoliticasController@index');
	Route::get('addexception', 'ExcepcionesController@add');
	Route::get('success', 'ApiController@generateMessage');
	Route::get('error', 'ApiController@generateError');
});

//ADMINISTRATOR
Route::group(array('prefix' => 'admin'), function () {
	Route::get('login/{idcliente?}', 'AdminController@index');
	Route::post('/', 'AdminController@login');

	Route::group(array('before' => 'auth'), function () {
		Route::get('logout', 'AdminController@logout');
		Route::get('cpanel', 'AdminController@cpanel');
		Route::group(array('prefix' => 'shorten'), function () {
			Route::post('/', 'ShortenController@postShorten');
			Route::get('generate', 'ShortenController@index');
		});
		Route::group(array('prefix' => 'survey'), function () {
			Route::get('load', 'AdminController@loadSurvey');
			Route::post('load', 'AdminController@modifySurvey');
		});
	});
});

Route::get('test/test', function () {
	// -----------------------------------------------------------------
	//var_dump(Ciudad::byRegion(1)->get()->toJson());
	//var_dump(Region::byPais(1)->get()->toJson());

	// -----------------------------------------------------------------
	//	$survey = new Encuesta(['fecha_creacion' => Carbon::now(), 'fecha_modificacion' => Carbon::now(), 'id_estado' => 1]);
	//	$survey->save();
	//	$client->encuesta()->associate($survey);
	//	$client->save();
	//	PreguntaCabecera::generateDefaultQuestions($survey);

	// -----------------------------------------------------------------
	//$clienteApariencia   = Cliente::find(3)->apariencias->first();
	//$encuestaPorCliente  = Cliente::find(4)->sector->encuestas->first()->titulo;
	//$sectorPorCliente    = Cliente::find(1)->sector;
	//$clientesPorSector   = Sector::find(2)->clientes;
	//$preguntasPorCliente = Cliente::find(1)->sector->encuestas->first()->preguntas;

	// -----------------------------------------------------------------
	//$survey    = Encuesta::find(2);
	//$question1 = new PreguntaCabecera(['descripcion_1' => 'Pregunta de Efectividad', 'numero_pregunta' => 1, 'id_tipo_respuesta' => 1, 'id_estado' => 1]);
	//$question1 = $survey->preguntas()->save($question1);
	//
	// dd($question1);

	// -----------------------------------------------------------------
	//$client = Cliente::find(9);
	//$survey = $client->sector->encuestas->first();
	//
	//if (is_null($survey)) {
	//	$survey = new Encuesta(['fecha_creacion' => Carbon::now(), 'fecha_modificacion' => Carbon::now(), 'id_estado' => 1]);
	//	$survey->save();
	//
	//	$client->id_encuesta = $survey->id_encuesta;
	//	$client->save();
	//}
	//
	//var_dump($survey);

	// -----------------------------------------------------------------
	//$survey = new Encuesta(['fecha_creacion' => Carbon::now(), 'fecha_modificacion' => Carbon::now(), 'id_estado' => 1]);
	//EncuestasController::generateDefaultSurvey($survey);
	//
	//$client->sector()->encuestas()->save($survey);
});