<?php

class RespuestasDetalleTableSeeder extends Seeder
{

	public function run()
	{
		RespuestaDetalle::create([
			'valor1'       => 5,
			'valor2'       => '',
			'id_respuesta' => 1
		]);
		RespuestaDetalle::create([
			'valor1'       => 0,
			'valor2'       => 'Porque....',
			'id_respuesta' => 2
		]);
		RespuestaDetalle::create([
			'valor1'       => 5,
			'valor2'       => '',
			'id_respuesta' => 3
		]);
		RespuestaDetalle::create([
			'valor1'       => 0,
			'valor2'       => 'Porque....',
			'id_respuesta' => 4
		]);
		RespuestaDetalle::create([
			'valor1'       => 5,
			'valor2'       => '',
			'id_respuesta' => 5
		]);
		RespuestaDetalle::create([
			'valor1'       => 0,
			'valor2'       => 'Porque....',
			'id_respuesta' => 6
		]);
	}

}