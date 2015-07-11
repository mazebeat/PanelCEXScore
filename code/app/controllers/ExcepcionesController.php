<?php

class ExcepcionesController extends \BaseController
{

	public function __construct()
	{
		//$this->beforeFilter('auth');
		$this->beforeFilter('csrf');
	}

	public function add()
	{
		$e               = new ExcepcionesCliente();
		$e->fecha        = Carbon::now();
		$e->id_cliente   = Auth::user()->id_cliente;
		$e->id_excepcion = 1;
		if($e->save()) {
			Session::flush();
			if(Request::ajax()) {
				return 'OK';
			}
		}

		return Redirect::to('http://www.umayor.cl');
	}
}
