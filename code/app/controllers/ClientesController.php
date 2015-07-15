<?php

class ClientesController extends \BaseController {

	/**
	 * Display a listing of clientes
	 *
	 * @return Response
	 */
	public function index()
	{
		$clientes = Cliente::all();

		return View::make('clientes.index', compact('clientes'));
	}

	/**
	 * Show the form for creating a new cliente
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('clientes.create');
	}

	/**
	 * Store a newly created cliente in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Cliente::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Cliente::create($data);

		return Redirect::route('clientes.index');
	}

	/**
	 * Display the specified cliente.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cliente = Cliente::findOrFail($id);

		return View::make('clientes.show', compact('cliente'));
	}

	/**
	 * Show the form for editing the specified cliente.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$cliente = Cliente::find($id);

		return View::make('clientes.edit', compact('cliente'));
	}

	/**
	 * Update the specified cliente in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$cliente = Cliente::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Cliente::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$cliente->update($data);

		return Redirect::route('clientes.index');
	}

	/**
	 * Remove the specified cliente from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Cliente::destroy($id);

		return Redirect::route('clientes.index');
	}

}
