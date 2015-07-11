<?php

class AdminController extends BaseController
{

	/**
	 * Display a listing of the resource.
	 * GET /admin
	 *
	 * @return Response
	 */
	public function index()
	{
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

			return Redirect::back()->withErrors($validator->messages())->withInput();
		}

		Event::fire('carga_cliente', array(e(Input::get('rut'))));
		$ultima_respuesta = Event::fire('ya_respondio')[0];

		if (!is_null($ultima_respuesta)) {
			$msg = array('data'    => array('type'  => 'warning',
			                                'title' => Session::get('user_name'),
			                                'text'  => 'En el actual periodo, ya registramos tus respuestas con fecha <b>' . $ultima_respuesta->format('d-m-Y') . '</b> a las <b>' . $ultima_respuesta->toTimeString() . '</b>, ¿Deseas actualizar esta información?',),
			             'options' => array(HTML::link('#', 'NO', array('class' => 'col-xs-4 col-sm-4 col-md-3 btn btn-default btn-lg text-uppercase',
			                                                            'id'    => 'btn_neg')),
			                                HTML::link('encuestas', 'SÍ', array('class' => 'col-xs-4 col-sm-4 col-md-3 btn btn-hot btn-lg text-uppercase pull-right',))));

			if (Request::ajax()) {
				return json_encode($msg);
			}

			return View::make('messages')->with('msg', $msg);
		}
		else {
			if (Request::ajax()) {
				return json_encode('OK');
			}

			return Redirect::to('encuestas');
		}
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

		return Redirect::to('/');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admin/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /admin/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin/{id}/edit
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admin/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}