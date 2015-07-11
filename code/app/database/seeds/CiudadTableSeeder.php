<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CiudadTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 5) as $index)
		{
			Ciudad::create([
               'id_region' => $index,
               'descripcion_ciudad' => $faker->city,
			]);
		}
	}

}