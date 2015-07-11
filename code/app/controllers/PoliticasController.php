<?php

class PoliticasController extends \BaseController
{

	public function __construct()
	{
		//$this->beforeFilter('auth');
		$this->beforeFilter('csrf');
	}

	public function index()
	{
		$theme = null;
		if (Session::has('theme')) {
			$theme = Session::get('theme');
		}

		$survey = null;
		if (Session::has('survey')) {
			$survey = Session::get('survey');
		}

		//dd($survey);
		//dd(Session::all());


		return View::make('politicas')->withTheme($theme)->withSurvey($survey);
	}
}
