<?php

class RespuestaTableSeeder extends Seeder
{

	public function run()
	{
		Respuesta::create(['id_estado'            => 1,
		                   'id_canal'             => 1,
		                   'id_encuesta'          => 1,
		                   'id_pregunta_cabecera' => 1,
		                   'id_pregunta_detalle'  => 1,]);
		Respuesta::create(['id_estado'            => 1,
		                   'id_canal'             => 1,
		                   'id_encuesta'          => 1,
		                   'id_pregunta_cabecera' => 2,
		                   'id_pregunta_detalle'  => 2,]);
		Respuesta::create(['id_estado'            => 1,
		                   'id_canal'             => 1,
		                   'id_encuesta'          => 1,
		                   'id_pregunta_cabecera' => 3,
		                   'id_pregunta_detalle'  => 3,]);
		Respuesta::create(['id_estado'            => 1,
		                   'id_canal'             => 1,
		                   'id_encuesta'          => 1,
		                   'id_pregunta_cabecera' => 4,
		                   'id_pregunta_detalle'  => 4,]);

		Respuesta::create(['id_estado'            => 1,
		                   'id_canal'             => 3,
		                   'id_encuesta'          => 1,
		                   'id_pregunta_cabecera' => 1,
		                   'id_pregunta_detalle'  => 1,]);
		Respuesta::create(['id_estado'            => 1,
		                   'id_canal'             => 3,
		                   'id_encuesta'          => 1,
		                   'id_pregunta_cabecera' => 2,
		                   'id_pregunta_detalle'  => 2,]);
		Respuesta::create(['id_estado'            => 1,
		                   'id_canal'             => 3,
		                   'id_encuesta'          => 1,
		                   'id_pregunta_cabecera' => 3,
		                   'id_pregunta_detalle'  => 3,]);
		Respuesta::create(['id_estado'            => 1,
		                   'id_canal'             => 3,
		                   'id_encuesta'          => 1,
		                   'id_pregunta_cabecera' => 4,
		                   'id_pregunta_detalle'  => 4,]);
	}
}