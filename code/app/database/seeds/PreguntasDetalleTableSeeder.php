<?php

class PreguntasDetalleTableSeeder extends Seeder
{

	public function run()
	{
		foreach (range(1, 7) as $index) {
			PreguntaDetalle::create(['descripcion_pregunta_detalle' => PreguntaCabecera::where('id_pregunta_cabecera', $index)->first(array('descripcion_1')),
			                         'id_estado'                    => 1,
			                         'id_encuesta'                  => 1,
			                         'id_pregunta_cabecera'         => $index,]);
		}
	}

}