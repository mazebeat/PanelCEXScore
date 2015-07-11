<?php

class DatabaseSeeder extends Seeder
{

	public function run()
	{
		Eloquent::unguard();

		$this->call('AparienciaTableSeeder');
		$this->call('CanalesTableSeeder');
		$this->call('EstadosTableSeeder');
		$this->call('PaisTableSeeder');
		$this->call('RegionTableSeeder');
		$this->call('CiudadTableSeeder');
		$this->call('EncuestasTableSeeder');
		$this->call('SectorTableSeeder');
		$this->call('MomentoTableSeeder');
		$this->call('MomentoSectorTableSeeder');
		$this->call('NegociosTableSeeder');
		$this->call('PlanTableSeeder');
		$this->call('TipoClienteTableSeeder');
		$this->call('ClientesTableSeeder');
		$this->call('ExcepcionesTableSeeder');
		$this->call('ExcepcionesClienteTableSeeder');
		$this->call('TiposRespuestaTableSeeder');
		$this->call('PreguntaCabeceraTableSeeder');
		$this->call('PreguntasDetalleTableSeeder');
		$this->call('RespuestaTableSeeder');
		$this->call('RespuestasDetalleTableSeeder');
		$this->call('ClienteRespuestaTableSeeder');
		$this->call('LinkTableSeeder');
		$this->call('EncuestaSectorTableSeeder');
	}

}
