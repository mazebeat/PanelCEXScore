<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExcepcionesClienteTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('excepciones_cliente', function (Blueprint $table) {
			$table->increments('id_excepcion_cliente');
			$table->datetime('fecha')->default('1900-01-01 00:00:00');
			$table->integer('id_cliente')->unsigned();
			$table->foreign('id_cliente')->references('id_cliente')->on('clientes');
			$table->integer('id_excepcion')->unsigned();
			$table->foreign('id_excepcion')->references('id_excepcion')->on('excepciones');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('excepciones_cliente');
	}

}
