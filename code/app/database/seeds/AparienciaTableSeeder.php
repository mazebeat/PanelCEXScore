<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AparienciaTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 3) as $index) {
			Apariencia::create(['logo_cliente' => $faker->imageUrl($width = 350, $height = 150),
			                    'color_header' => $faker->hexcolor,
			                    'color_body'   => $faker->hexcolor,
			                    'color_footer' => $faker->hexcolor,]);
		}
	}

}