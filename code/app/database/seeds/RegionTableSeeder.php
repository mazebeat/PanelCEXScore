<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RegionTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 10) as $index) {
			var_dump($faker->state);
			Region::create(['descripcion_region' => $faker->state,
			                'id_pais'            => $index,]);
		}
	}

}