<?php

class ExcepcionesTableSeeder extends Seeder
{

	public function run()
	{
		Excepcion::create([
			'descripcion_excepcion' => 'Usuario no desea responder encuesta',
		]);
	}

}