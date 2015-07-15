<?php

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

	public function cpanel()
	{
		return View::make('admin.cpanel');
	}

	public function modifySurvey()
	{
		$inputs    = Input::except(['_token', 'survey', 'plan']);
		$questions = Auth::user()->cliente->encuesta->preguntas;
		//$questions  = Session::get('user_back')->cliente->encuesta->preguntas;
		$idencuesta = Crypt::decrypt(Input::get('survey'));
		$idplan     = Crypt::decrypt(Input::get('plan'));
		$x          = 1;


		if ($idplan != 1 && count($inputs) > 0) {
			for ($i = 0; $i < count($questions); $i++) {

				if ($questions[$i]->id_encuesta == $idencuesta && is_null($questions[$i]->id_pregunta_padre)) {
					$questions[$i]->descripcion_1 = trim(e(Input::get('question' . $x)));
					if ($questions[$i]->save()) {
						$x++;
					}
				}
			}
		}

		return Redirect::to('admin/survey/load');
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
