<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PlanTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

		//foreach(range(1, 10) as $index)
		//{
		Plan::create(['descripcion_plan' => 'free',
		              'id_estado'        => 1]);
		Plan::create(['descripcion_plan' => 'profesional',
		              'id_estado'        => 1]);
		Plan::create(['descripcion_plan' => 'premium',
		              'id_estado'        => 1]);
		//}
	}

}