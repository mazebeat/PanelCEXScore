<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ClienteRespuestaTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 6) as $index) {
			ClienteRespuesta::create(['id_cliente'       => $index,
			                          'ultima_respuesta' => $faker->dateTime,
			                          'id_respuesta'     => $index,]);
		}
	}

}