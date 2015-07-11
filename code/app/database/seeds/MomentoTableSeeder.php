<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class MomentoTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 4) as $index) {
			Momento::create(['descripcion_momento' => $faker->text(100),
			                 'medicion'            => $faker->text(50),
			                 'id_estado'           => 1]);
		}
	}

}