<?php

class EncuestasController extends \BaseController
{
	public function __construct()
	{
		$this->beforeFilter('csrf');
	}

	public function index($idcliente = null, $canal = null)
	{
		if (isset($idcliente) && isset($canal)) {

			if (Auth::check() && Session::has('canal') && Session::has('theme') && Session::has('survey')) {
				return View::make('encuesta')->withTheme(Session::get('theme'))->withSurvey(Session::get('survey'));
			}

			if (Session::has('canal')) {
				Session::forget('canal');
			}

			$canal = Canal::whereCodigoCanal(Crypt::decrypt($canal))->first(array('id_canal'));
			if (isset($canal) && $canal->exists) {
				Session::put('canal', Crypt::encrypt($canal->id_canal));
			}

			try {
				$id     = Crypt::decrypt($idcliente);
				$client = Cliente::find($id);

				if ($client->first()->exists) {

					Auth::loginUsingId($id);

					$survey = $client->sector->encuestas->first();
					$theme  = $client->apariencias->first();

					if (!(isset($theme) && $theme->exists)) {
						$theme = Apariencia::find(1);
					}

					if (!Session::has('theme')) {
						Session::put('theme', $theme);
					}

					if (!Session::has('survey')) {
						Session::put('survey', $survey);
					}

					if (!Session::has('idcliente')) {
						Session::put('idcliente', $idcliente);
					}

					//dd(Session::all());

					return View::make('encuesta')->withTheme($theme)->withSurvey($survey);
				}

				var_dump('Not found client');

			} catch (Exception $e) {
				var_dump($e->getMessage());
			}
		}

		return Redirect::to('survey/error');
	}

	public function store()
	{
		$inputs = Input::except('_token');

		if (!Auth::check()) {
			return Redirect::to('/' . Session::get('shorten'));
		}

		if (!static::validateAnswers($inputs)) {
			$errors = 'Debe contestar todas las preguntas.';

			return Redirect::back()->withErrors($errors)->withInput($inputs);
		}

		$answers = static::processAnswers($inputs);

		if (!isset($answers)) {
			$errors = 'Error en la consulta.';

			return Redirect::back()->withErrors($errors)->withInput($inputs);
		}

		$cr                   = new ClienteRespuesta();
		$cr->id_cliente       = Auth::id();
		$cr->ultima_respuesta = Carbon::now();
		$cr->id_estado        = 15;

		//$id_cliente = Crypt::decrypt(Session::get('idcliente');
		//$id_cliente = Crypt::decrypt(Auth::id());
		//$client = Cliente::find($id_cliente);

		//$client->respuestas()->attach($id_respuesta, array('ultima_respuesta' => Carbon::now(), 'id_estado' => 15));


		if (!is_null($cli_resp)) {
			$respuesta_detalle = array();

			foreach ($inputs as $key => $value) {
				if ($key != '_token') {
					$data = array('fecha'                => Carbon::now(),
					              'id_estado'            => '6',
					              'id_canal'             => Session::get('canal'),
					              'id_encuesta'          => Session::get('encuesta', 1),
					              'id_pregunta'          => (int)str_replace('pregunta_', '', $key),
					              'id_pregunta_detalle'  => 1,
					              'id_cliente'           => Auth::user()->id_cliente,
					              'id_cliente_respuesta' => $cli_resp,
					              'created_at'           => Carbon::now());

					$respuesta = Respuesta::insertGetId($data);

					if (!is_null($respuesta)) {
						$val  = array_get($value, 'value');
						$text = array_get($value, 'text');
						array_push($respuesta_detalle, array('valor1'       => trim($val) != '' ? $val : null,
						                                     'valor2'       => trim($text) != '' && Str::length($text) > 0 ? $text : null,
						                                     'id_respuesta' => $respuesta,
						                                     'created_at'   => Carbon::now()));
					}
					else {
						$msg = array('data' => array('type' => 'danger',
						                             'text' => 'Error al enviar el formulario'));

						return Redirect::back()->with('msg', $msg)->withInput($inputs);
					}
				}
			}
		}

		unset($resp_d);
		unset($resp);
		unset($inputs);
		unset($answers);

		if (RespuestaDetalle::insert($respuesta_detalle)) {
			$theme = null;
			if (Session::has('theme')) {
				$theme = Session::get('theme');
			}

			Session::flush();
			$msg    = array('data' => array('type' => 'success',
			                                'text' => '<i class="fa fa-check fa-fw"></i>Gracias por tu tiempo y disponibilidad en responder, ¡Tu opinión es muy importante!'));
			$script = "setTimeout('window.location.href=\"" . URL::to('/') . "/\";', 5000); if (typeof window.event == 'undefined'){ document.onkeypress = function(e){ var test_var=e.target.nodeName.toUpperCase(); if (e.target.type) var test_type=e.target.type.toUpperCase(); if ((test_var == 'INPUT' && test_type == 'TEXT') || test_var == 'TEXTAREA'){ return e.keyCode; }else if (e.keyCode == 8 || e.keyCode == 116 || e.keyCode == 122){ e.preventDefault(); } } }else{ document.onkeydown = function(){ var test_var=event.srcElement.tagName.toUpperCase(); if (event.srcElement.type) var test_type=event.srcElement.type.toUpperCase(); if ((test_var == 'INPUT' && test_type == 'TEXT') || test_var == 'TEXTAREA'){ return event.keyCode; } else if (event.keyCode == 8 || e.keyCode == 116 || e.keyCode == 122){ event.returnValue=false; } } } ";


			Auth::logout();
			Session::flush();

			return View::make('messages')->withMsg($msg)->withScript($script)->withTheme($theme);
		}
		else {
			$msg = array('data' => array('type' => 'danger',
			                             'text' => 'Error al enviar el formulario'));

			return Redirect::back()->with('msg', $msg)->withInput(Input::all());
		}
	}

	/**
	 * @param array $inputs
	 *
	 * @return bool
	 */
	public static function validateAnswers(array $inputs)
	{
		if (!is_array($inputs)) {
			return false;
		}

		$count = 0;

		foreach ($inputs as $key => $value) {
			if (Str::startsWith($key, 'question')) {
				$count++;
			}
		}

		if ($count === 4) {
			return true;
		}

		return false;
	}

	/**
	 * @param array $inputs
	 *
	 * @return null|\stdClass
	 */
	public static function processAnswers(array $inputs)
	{
		if (!is_array($inputs)) {
			return null;
		}

		return static::processKeyAnswer($inputs);
	}

	/**
	 * @param array $inputs
	 *
	 * @return \stdClass
	 */
	public static function processKeyAnswer(array $inputs)
	{
		$answers = new stdClass();

		foreach ($inputs as $key => $value) {

			if (Str::startsWith($key, 'question')) {
				$split = explode('_', $key);
				$name  = $split[0] . $split[1];

				$tmp = array('id_pregunta_cabecera' => (int)$split[2]);

				if (is_array($value)) {
					foreach ($value as $k => $v) {
						if ($k == 'value') {
							$tmp[$k] = (int)$v;
						}
						else {
							$tmp[$k] = $v;
						}
					}
				}

				$answers->$name = (object)$tmp;
			}
			else {
				if ($value == null || empty($value)) {
					$value = null;
				}
				$answers->$key = $value;
			}
		}

		return $answers;
	}
}
