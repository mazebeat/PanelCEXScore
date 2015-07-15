<?php

use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\Exporter\Exception;

class EncuestasController extends \ApiController
{
	public function __construct()
	{
		//parent::__construct();
		//$this->beforeFilter('csrf');
	}

	/**
	 * @param \Encuesta $survey
	 */
	public static function generateDefaultSurvey(Encuesta $survey)
	{
		$question1 = new PreguntaCabecera(['descripcion_1' => 'Pregunta de Efectividad', 'numero_pregunta' => 1, 'id_tipo_respuesta' => 1, 'id_estado' => 1, 'id_momento' => 1]);
		$question1 = $survey->preguntas()->save($question1);

		$subquestion1 = new PreguntaCabecera(['descripcion_1'     => '¿Por qué califica con esa nota? (opcional)',
		                                      'id_pregunta_padre' => $question1->id_pregunta_cabecera,
		                                      'id_tipo_respuesta' => 5,
		                                      'id_estado'         => 1,
		                                      'id_momento'        => 1]);
		$survey->preguntas()->save($subquestion1);

		$question2 = new PreguntaCabecera(['descripcion_1' => 'Pregunta de Facilidad', 'numero_pregunta' => 2, 'id_tipo_respuesta' => 1, 'id_estado' => 1, 'id_momento' => 2]);
		$question2 = $survey->preguntas()->save($question2);

		$subquestion2 = new PreguntaCabecera(['descripcion_1'     => '¿Por qué califica con esa nota? (opcional)',
		                                      'id_pregunta_padre' => $question2->id_pregunta_cabecera,
		                                      'id_tipo_respuesta' => 5,
		                                      'id_estado'         => 1,
		                                      'id_momento'        => 2]);
		$survey->preguntas()->save($subquestion2);

		$question3 = new PreguntaCabecera(['descripcion_1' => ' Pregunta de lo Grato de la interacción', 'numero_pregunta' => 3, 'id_tipo_respuesta' => 1, 'id_momento' => 3]);
		$question3 = $survey->preguntas()->save($question3);

		$subquestion3 = new PreguntaCabecera(['descripcion_1'     => '¿Por qué califica con esa nota? (opcional)',
		                                      'id_pregunta_padre' => $question3->id_pregunta_cabecera,
		                                      'id_tipo_respuesta' => 5,
		                                      'id_estado'         => 1,
		                                      'id_momento'        => 3]);
		$survey->preguntas()->save($subquestion3);

		$question4 = new PreguntaCabecera(['descripcion_1'     => '¿Recomendaría nuestra empresa a sus amigos/conocidos?',
		                                   'numero_pregunta'   => 4,
		                                   'id_tipo_respuesta' => 6,
		                                   'id_estado'         => 1,
		                                   'id_momento'        => 4]);
		$survey->preguntas()->save($question4);
	}

	/**
	 * @param null $idcliente
	 * @param null $canal
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function index($idcliente = null, $canal = null, $momento = null)
	{

		if (isset($idcliente) && isset($canal) && isset($momento)) {

			//if (Session::has('idcliente') && Session::has('canal') && Session::has('theme') && Session::has('survey')) {
			//	return View::make('survey.encuesta')->withTheme(Session::get('theme'))->withSurvey(Session::get('survey'));
			//}

			try {
				if (Session::has('canal')) {
					Session::forget('canal');
				}

				$canal = Canal::whereCodigoCanal(Crypt::decrypt($canal))->first(array('id_canal'));

				if (isset($canal) && $canal->exists) {
					Session::put('canal', Crypt::encrypt($canal->id_canal));
				}
				else {
					$error          = new stdClass();
					$error->code    = 500;
					$error->message = 'Canala no encontrado.';

					return Redirect::to('survey/error')->with('error', $error);
				}

				$id = Crypt::decrypt($idcliente);

				if (Cache::get('finish') && $id == Cache::get('idcliente')) {
					return Redirect::to('survey/success');
				}

				//if (Session::has('idcliente') && $id != Crypt::decrypt(Session::get('idcliente'))) {
				Session::forget('theme');
				Session::forget('survey');
				Session::forget('idcliente');
				Cache::flush();
				//}

				$client = Cliente::find($id);

				if ($client->first()->exists) {

					$plan = $client->plan;

					if (!is_null($plan)) {
						$survey = $client->encuesta;
						$theme  = $client->apariencias->first();

						if (!Session::has('theme')) {
							Session::put('theme', $theme);
						}

						if (!Session::has('survey')) {
							Session::put('survey', $survey);
						}

						if (!Session::has('idcliente')) {
							Session::put('idcliente', $idcliente);
						}
					}

					return View::make('survey.encuesta')->withTheme($theme)->withSurvey($survey)->withIdplan($plan->id_plan);
				}

				//var_dump('Not found client');

			} catch (Exception $e) {
				$error          = new stdClass();
				$error->code    = $e->getCode();
				$error->message = $e->getMessage();

				return Redirect::to('survey/error')->with('error', $error);
			}
		}

		return Redirect::to('survey/error');
	}

	/**
	 * @return $this|\Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		$inputs = Input::except('_token');

		if (!Session::has('idcliente')) {
			$errors = 'Cliente no identificado.';

			return Redirect::back()->withErrors($errors)->withInput($inputs);
		}

		if (!static::validateAnswers($inputs)) {
			$errors = 'Debe contestar todas las preguntas.';

			return Redirect::back()->withErrors($errors)->withInput($inputs);
		}

		$data = static::processAnswers($inputs);

		if (is_null($data) && !static::objectHasProperty($data['answers'])) {
			$errors = 'Error en la consulta.';

			return Redirect::back()->withErrors($errors)->withInput($inputs);
		}

		$id_cliente = Crypt::decrypt(Session::get('idcliente'));
		$client     = Cliente::find($id_cliente);
		$survey     = Session::get('survey');

		foreach ($data['answers'] as $key => $value) {
			$respuesta                       = new Respuesta();
			$respuesta->id_estado            = 1;
			$respuesta->id_canal             = Crypt::decrypt(Session::get('canal'));
			$respuesta->id_encuesta          = $survey->id_encuesta;
			$respuesta->id_pregunta_cabecera = $value->id_pregunta_cabecera;
			//$respuesta->id_pregunta_detalle  = 1;

			$respuesta = $client->respuestas()->save($respuesta, ['ultima_respuesta' => Carbon::now(), 'id_estado' => 1]);

			$respuestaDetalle = new RespuestaDetalle();
			if (isset($value->value)) {
				$respuestaDetalle->valor1 = $value->value;
			}
			else {
				$respuestaDetalle->valor1 = null;
			}
			if (isset($value->text)) {
				$respuestaDetalle->valor2 = $value->text;
			}
			else {
				$respuestaDetalle->valor2 = null;
			}
			$respuestaDetalle->id_respuesta = $respuesta->id_respuesta;
			$respuestaDetalle->save();
		}
		if (count($data['user']) && static::objectHasProperty($data['user'])) {
			$value                 = $data['user'];
			$user                  = new Usuario();
			$user->nombre_usuario  = $value->name;
			$user->edad_usuario    = $value->age;
			$user->genero_cliente  = $value->gender;
			$user->correo_cliente  = $value->email;
			$user->id_tipo_usuario = 3;
			$user->id_cliente      = Crypt::decrypt(Session::get('idcliente'));
			if (isset($value->wish_email) && (int)$value->wish_email == 1) {
				$user->desea_correo_cliente = 'NO';
			}
			$user->save();
		}

		return Redirect::to('survey/success');
	}

	/**
	 * @param array $inputs
	 *
	 * @return bool
	 */
	public static function validateAnswers(array $inputs)
	{
		try {
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
		} catch (Exception $e) {
			static::throwError($e);
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
		try {
			if (!is_array($inputs)) {
				return null;
			}

			return static::processKeyAnswer($inputs);
		} catch (Exception $e) {
			static::throwError($e);
		}

		return null;
	}

	/**
	 * @param array $inputs
	 *
	 * @return array
	 */
	public static function processKeyAnswer(array $inputs)
	{
		$answers = new stdClass();
		$user    = new stdClass();

		try {
			foreach ($inputs as $key => $value) {

				if (Str::startsWith($key, 'question')) {
					$split = explode('_', $key);
					$name  = $split[0] . $split[1];

					$tmp = array('id_pregunta_cabecera' => (int)$split[2]);

					if (is_array($value)) {
						foreach ($value as $k => $v) {
							if ($k == 'value' && !is_null($v)) {
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
					$user->$key = $value;
				}
			}
		} catch (Exception $e) {
			static::throwError($e);
		}

		return ['answers' => $answers, 'user' => $user];
	}
}