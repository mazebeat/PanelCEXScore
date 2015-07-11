<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class EncuestaSectorTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 4) as $index) {
			EncuestaSector::create(['id_encuesta' => 1,
			                        'id_sector'  => $index]);
		}
	}

}