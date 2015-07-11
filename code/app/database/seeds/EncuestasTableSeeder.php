<?php

class EncuestasTableSeeder extends Seeder
{

	public function run()
	{
		foreach (range(1, 3) as $index) {
			Encuesta::create(['titulo'             => 'Encuesta ' . $index,
			                  'id_estado'          => 1,
			                  'fecha_creacion'     => Carbon::now(),
			                  'fecha_modificacion' => Carbon::now(),]);
		}
	}
}