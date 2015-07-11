<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class MomentoSectorTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 4) as $index) {
			MomentoSector::create(['id_momento'                 => $index,
			                       'id_sector'                  => 1,
			                       'descripcion_momento_sector' => $faker->text(50),
			                       'id_estado'                  => 1]);
		}
	}

}