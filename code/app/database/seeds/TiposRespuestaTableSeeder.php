<?php

class TiposRespuestaTableSeeder extends Seeder
{

	public function run()
	{
		TipoRespuesta::create([
			'tipo' => 'Opcion única',
		]);
		TipoRespuesta::create([
			'tipo'     => 'Opcion únicacon respuesta texto (Linea simple)',
			'opciones' => '{"chart_max"}'
		]);
		TipoRespuesta::create([
			'tipo' => 'Multiopcion',
		]);
		TipoRespuesta::create([
			'tipo'     => 'Multiopcion con respuesta texto (Linea simple)',
			'opciones' => '{"chart_max"}'
		]);
		TipoRespuesta::create([
			'tipo'     => 'Por rango de valor',
			'opciones' => '{"min","max"}'
		]);
		TipoRespuesta::create([
			'tipo'     => 'Respuesta texto (Linea simple)',
			'opciones' => '{"chart_max"}'
		]);
		TipoRespuesta::create([
			'tipo'     => 'Respuesta texto (Multilinea)',
			'opciones' => '{"chart_max","row"}'
		]);
	}
}