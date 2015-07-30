<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use SebastianBergmann\Exporter\Exception;

class AdminController extends \ApiController
{
	/**
	 * AdminController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('csrf');
	}

	/**
	 * Display a listing of the resource.
	 * GET /admin
	 *
	 * @return Response
	 */
	public function index($idcliente = null)
	{
		if (!Auth::guest()) {
			return Redirect::to('admin/cpanel');
		}

		if (is_null($idcliente)) {
			$theme = Apariencia::find(Config::get('default.idapariencia'));
		}
		else {
			$client = Cliente::find($idcliente);

			if (!is_null($client)) {
				$theme = $client->apariencias->first();
			}
			else {
				$theme = Apariencia::find(Config::get('default.idapariencia'));
			}
		}

		if ($theme->first()->exists) {
			return View::make('admin.index')->withTheme($theme);
		}

		return Redirect::to('admin/login');
	}

	/**
	 * @return $this|\Illuminate\Http\RedirectResponse|string
	 */
	public function login()
	{
		if (!Auth::guest()) {
			return Redirect::to('admin/cpanel');
		}

		//$rules = array('rut' => 'required|between:8,9|alpha_num|rut|exist_rut');
		$rules = ['username' => 'required', 'password' => 'required'];

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			if (Request::ajax()) {
				return json_encode('ERROR');
			}

			return Redirect::back()->withErrors($validator->messages())->withInput(Input::except('_token'));
		}

		$user = User::whereNombreUsuario(Input::get('username'))->wherePassword(Input::get('password'))->first();

		if (is_null($user)) {
			$error = new Illuminate\Support\MessageBag();
			$error->add('rut', 'Cliente no registrado');

			return Redirect::back()->withErrors($error)->withInput(Input::except('_token'));
		}

		Auth::login($user, true);

		if (Auth::guest()) {
			return Redirect::to('admin/login');
		}

		return Redirect::to('admin/cpanel');
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse|string
	 */
	public function logout()
	{
		//Session::flush();
		Auth::logout();

		if (Request::ajax()) {
			return $msg = 'OK';
		}

		return Redirect::to('admin/login');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function cpanel()
	{
		return View::make('admin.cpanel');
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function modifySurvey()
	{
		$inputs    = Input::except(['_token', 'survey', 'plan']);
		$valid     = static::createBasicRules($inputs);
		$validator = Validator::make(Input::all(), $valid['rules'], $valid['messages']);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput(Input::except('_token'));
		}

		$questions = Auth::user()->cliente->encuesta->preguntas;
		// $questions  = Session::get('user_back')->cliente->encuesta->preguntas;
		$idencuesta = Crypt::decrypt(Input::get('survey'));
		$idplan     = Crypt::decrypt(Input::get('plan'));
		$x          = 0;

		if ($idplan == 1) {
			$errors = new MessageBag();
			$errors->add('inesperado', 'No mantiene los privilegios para modificar.');

			return Redirect::back()->withErrors($errors)->withInput(Input::except('_token'));
		}

		if (count($inputs) <= 0) {
			$errors = new MessageBag();
			$errors->add('inesperado', 'Cantidad de textos incorrecta.');

			return Redirect::back()->withErrors($errors)->withInput(Input::except('_token'));
		}

		$ids = self::FilterQuestions($inputs);

		foreach ($questions as $question) {


			if ($question->id_encuesta == $idencuesta && array_key_exists($question->id_pregunta_cabecera, $ids) && is_null($question->id_pregunta_padre)) {
				$question->descripcion_1 = $ids[$question->id_pregunta_cabecera];

				if ($question->save()) {
					$x++;
				}
			}
		}

		if ($x != 4) {
			$errors = new MessageBag();
			$errors->add('inesperado', 'Error al procesar solicitud.');

			return Redirect::back()->withErrors($errors)->withInput(Input::except('_token'));
		}

		return Redirect::to('admin/survey/load');
	}

	/**
	 * @param null $inputs
	 *
	 * @return array
	 */
	public static function createBasicRules($inputs = null)
	{
		$rules    = [];
		$messages = [];
		$count    = 1;

		if (!is_null($inputs)) {
			foreach ($inputs as $key => $value) {
				$rules[$key]                  = 'required';
				$messages[$key . '.required'] = 'El texto en la pregunta ' . $count++ . ' es obligatorio.';
			}
		}

		return array('rules' => $rules, 'messages' => $messages);
	}

	/**
	 * @param $inputs
	 * @param $ids
	 *
	 * @return mixed
	 */
	public static function FilterQuestions($inputs)
	{
		try {
			foreach ($inputs as $key => $value) {
				if (Str::startsWith($key, 'question')) {
					$id       = (int)str_replace('question', '', $key);
					$ids[$id] = $value;
				}
			}
		} catch (Exception $ex) {
			var_dump($ex->getMessage());
		}

		return $ids;
	}

	/**
	 * @return mixed
	 */
	public function loadSurvey()
	{
		//dd(Auth::user()->cliente);
		$client = Auth::user()->cliente;
		//$client = Cliente::find(Session::get('idcliente_back'));
		$plan = $client->plan;

		if (!is_null($plan)) {
			$idplan = $plan->id_plan;
			$survey = $client->encuesta;

			if (is_null($survey)) {
				throw new Exception('Cliente no tiene encuesta');
			}

			return View::make('admin.survey.loadSurvey')->withSurvey($survey)->withIdplan($idplan);
		}

		throw new Exception('Cliente no tiene plan');
	}

	/**
	 * @return $this
	 */
	public function createClient()
	{
		// Validate input values
		$validator = Validator::make(Input::all(), Cliente::$rules);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput(Input::except('_token'));
		}

		// Create survey
		$survey = Encuesta::create(['id_estado' => 1]);

		// Generate default questions
		PreguntaCabecera::generateDefaultQuestions($survey);

		// Create client
		$client = Cliente::firstOrCreate(['rut_cliente'       => Input::get('rut_cliente'),
		                                  'nombre_cliente'    => Input::get('nombre_cliente'),
		                                  'fono_cliente'      => Input::get('fono_cliente'),
		                                  'correo_cliente'    => Input::get('correo_cliente'),
		                                  'direccion_cliente' => Input::get('direccion_cliente'),
		                                  'id_sector'         => Input::get('sector'), // ????
		                                  'id_ciudad'         => Input::get('ciudad'),
		                                  'id_tipo_cliente'   => Input::get(''), // 1
		                                  'id_plan'           => Input::get('plan')]);

		// Assciate survey to client
		$client->encuesta()->associate($survey);
		$client->save();
	}
}