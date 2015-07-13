<?php

use SebastianBergmann\Exporter\Exception;

class ApiController extends Controller
{
	/**
	 * ApiController constructor.
	 */
	public function __construct()
	{
	}

	/**
	 * @param $input
	 *
	 * @return bool
	 */
	public static function objectHasProperty($input)
	{
		return (is_object($input) && array_filter(get_object_vars($input), function ($val) {
					return (is_string($val) && strlen($val)) || ($val !== null);
				})) ? true : false;
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function generateMessage()
	{
		if (!Session::has('message') || !is_object(Session::get('message'))) {
			$message           = new stdClass();
			$message->title    = Str::hes('&iexcl;Agradecemos sus Respuestas&#33;');
			$message->subtitle = '';
		}
		else {
			$message = Session::get('message');
		}

		//$script = "setTimeout('window.location.href=\"" . URL::to('/') . "/\";', 5000); if (typeof window.event == 'undefined'){ document.onkeypress = function(e){ var test_var=e.target.nodeName.toUpperCase(); if (e.target.type) var test_type=e.target.type.toUpperCase(); if ((test_var == 'INPUT' && test_type == 'TEXT') || test_var == 'TEXTAREA'){ return e.keyCode; }else if (e.keyCode == 8 || e.keyCode == 116 || e.keyCode == 122){ e.preventDefault(); } } }else{ document.onkeydown = function(){ var test_var=event.srcElement.tagName.toUpperCase(); if (event.srcElement.type) var test_type=event.srcElement.type.toUpperCase(); if ((test_var == 'INPUT' && test_type == 'TEXT') || test_var == 'TEXTAREA'){ return event.keyCode; } else if (event.keyCode == 8 || e.keyCode == 116 || e.keyCode == 122){ event.returnValue=false; } } } ";
		$script = '';

		if (Session::has('theme') && Session::has('survey')) {
			$theme  = Session::get('theme');
			$survey = Session::get('survey');
			Cache::put('theme', $theme, 5);
			Cache::put('survey', $survey, 5);
		}
		else {
			if (Cache::has('theme') && Cache::has('survey')) {
				$theme  = Cache::get('theme');
				$survey = Cache::get('survey');
			}
			else {
				return Redirect::to('survey/error');
			}
		}

		Cache::put('finish', true, 2);

		Session::flush();

		return View::make('survey.messages')->withMessage($message)->withScript($script)->withTheme($theme)->withSurvey($survey);
	}

	/**
	 * @return mixed
	 */
	public function generateError()
	{
		try {
			if (!Session::has('error') || !is_object(Session::get('error'))) {
				$error          = new stdClass();
				$error->code    = 401;
				$error->message = 'Cliente no encontrado.';
			}
			else {
				$error = Session::get('error');
			}

			if (Session::has('theme') && Session::has('survey')) {
				$theme  = Session::get('theme');
				$survey = Session::get('survey');
				Cache::put('theme', $theme, 5);
				Cache::put('survey', $survey, 5);
			}
			else {
				if (Cache::has('theme') && Cache::has('survey')) {
					$theme  = Cache::get('theme');
					$survey = Cache::get('survey');
				}
				else {
					return View::make('survey.errors')->withError($error);
				}
			}

			Session::flush();

			return View::make('survey.errors')->withError($error)->withTheme($theme)->withSurvey($survey);
		} catch (Exception $e) {
			static::throwError($e);
		}
	}

	function throwError(Exception $e)
	{
		if (!Config::get('app.debug')) {
			$error          = new stdClass();
			$error->code    = $e->getCode();
			$error->message = $e->getMessage();

			return Redirect::to('survey/error')->with('error', $error);
		}

		throw $e;
	}
}
