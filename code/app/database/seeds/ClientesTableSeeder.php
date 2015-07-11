<?php
use Faker\Factory as Faker;

class ClientesTableSeeder extends Seeder
{

	public function run()
	{
		$faker = Faker::create();
		foreach (range(1, 5) as $index) {
			Cliente::create(['id_estado'            => $faker->numberBetween(1, 2),
			                 'rut_cliente'          => $faker->postcode,
			                 'nombre_cliente'       => $faker->firstNameMale,
			                 'fono_cliente'         => $faker->phoneNumber,
			                 'correo_cliente'       => $faker->email,
			                 'direccion_cliente'    => $faker->address,
			                 'informacion_cliente'  => $faker->numberBetween(0, 1),
			                 'desea_correo_cliente' => 'N',
			                 'id_ciudad'            => $index,
			                 'id_tipo_cliente'      => 2,
			                 'id_sector'            => 1,
			                 'id_apariencia'        => 4,
			                 'id_plan'              => 1,]);
		}
	}

}