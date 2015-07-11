<?php

class CanalesTableSeeder extends Seeder
{

	public function run()
	{
		Canal::create(['codigo_canal'      => 'em',
		               'descripcion_canal' => 'Emails']);
		Canal::create(['codigo_canal'      => 'fa',
		               'descripcion_canal' => 'Facebook']);
		Canal::create(['codigo_canal'      => 'ba',
		               'descripcion_canal' => 'Banner portal estudiantil']);
		Canal::create(['codigo_canal'      => 'ap',
		               'descripcion_canal' => 'APP InfoUMayor']);
		Canal::create(['codigo_canal'      => 'ca',
		               'descripcion_canal' => 'Call center']);
		Canal::create(['codigo_canal'      => 'ce',
		               'descripcion_canal' => 'Centros de atención presencial']);
	}

}