<?php

use Faker\Factory as Faker;

class ExcepcionesClienteTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

		ExcepcionCliente::create([
			'fecha'        => $faker->dateTimeThisYear(),
			'id_cliente'   => 5,
			'id_excepcion' => 1,
		]);
	}

}