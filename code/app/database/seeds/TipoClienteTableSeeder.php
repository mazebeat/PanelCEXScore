<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TipoClienteTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();

		//foreach(range(1, 2) as $index)
		//{
		TipoCliente::create(['descripcion_tipo_cliente' => 'administrador']);
		TipoCliente::create(['descripcion_tipo_cliente' => 'comun']);
		//}
	}

}