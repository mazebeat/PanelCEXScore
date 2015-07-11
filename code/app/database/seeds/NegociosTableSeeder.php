<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class NegociosTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 4) as $index) {
			Negocio::create(['descripcion_negocio' => $faker->company,
			                 'id_estado'   => 1]);
		}
	}

}