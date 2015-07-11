<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class LinkTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

		foreach (range(1, 5) as $index) {
			Link::create(['descripcion_link' => $faker->realText(100, 2),
			              'url_link'         => $faker->url,
			              'url_corta'        => $faker->url,
			              'id_sector'        => 1,
			              'id_canal'         => $index,
			              'id_cliente'       => $index,
			              'id_estado'        => 1]);
		}
	}

}