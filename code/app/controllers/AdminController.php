<?php

class AdminController extends \ApiController
{

	/**
	 * Display a listing of the resource.
	 * GET /admin
	 *
	 * @return Response
	 */
	public function index()
	{
		$theme = Apariencia::find(Config::get('default.idapariencia'));

		if ($theme->first()->exists) {
			return View::make('admin.index')->withTheme($theme);
		}

		return View::make('admin.index');
	}

	/**
	 * @return $this|\Illuminate\Http\RedirectResponse|string
	 */
	public function login()
	{
		$rules = array('rut' => 'required|between:8,9|alpha_num|rut|exist_rut');

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			if (Request::ajax()) {
				return json_encode('ERROR');
			}

			return Redirect::back()->withErrors($validator->messages())->withInput(Input::except('_token'));
		}

		//$ultima_respuesta = Event::fire('ya_respondio')[0];
		//if (!is_null($ultima_respuesta)) {
		//	$msg = array('data'    => array('type'  => 'warning',
		//	                                'title' => Session::get('user_name'),
		//	                                'text'  => 'En el actual periodo, ya registramos tus respuestas con fecha <b>' . $ultima_respuesta->format('d-m-Y') . '</b> a las <b>' . $ultima_respuesta->toTimeString() . '</b>, ¿Deseas actualizar esta información?',),
		//	             'options' => array(HTML::link('#', 'NO', array('class' => 'col-xs-4 col-sm-4 col-md-3 btn btn-default btn-lg text-uppercase',
		//	                                                            'id'    => 'btn_neg')),
		//	                                HTML::link('encuestas', 'SÍ', array('class' => 'col-xs-4 col-sm-4 col-md-3 btn btn-hot btn-lg text-uppercase pull-right',))));
		//
		//	if (Request::ajax()) {
		//		return json_encode($msg);
		//	}
		//
		//	return View::make('messages')->with('msg', $msg);
		//}
		//else {
		//	if (Request::ajax()) {
		//		return json_encode('OK');
		//	}
		//
		//}

		$client = Cliente::whereRutCliente(Input::get('rut'))->first();

		if (is_null($client)) {
			$error = new Illuminate\Support\MessageBag();
			$error->add('rut', 'Cliente no registrado');

			return Redirect::back()->withErrors($error)->withInput(Input::except('_token'));
		}

		Auth::login($client);

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
		Session::flush();
		Auth::logout();

		if (Request::ajax()) {
			return $msg = 'OK';
		}

		return Redirect::to('admin/login');
	}

	public function cpanel()
	{
		$client = Cliente::find(10);
		$plan   = $client->plan;

		if (!is_null($plan)) {
			if ($plan->id_plan == 1) {
				$theme  = Apariencia::find(1);
				$survey = Encuesta::find(1);
			}
			else {
				$survey = $client->sector->encuestas->first();
				$theme  = $client->apariencias->first();
			}
		}

		return View::make('admin.cpanel');
	}

	public function modifySurvey()
	{

	}
}