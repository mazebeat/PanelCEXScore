<?php

class EstadosTableSeeder extends Seeder
{

	public function run()
	{
		Estado::create(['tipo_estado'        => 'estado',
		                'descripcion_estado' => 'activo',]);
		Estado::create(['tipo_estado'        => 'estado',
		                'descripcion_estado' => 'inactivo',]);
	}
}