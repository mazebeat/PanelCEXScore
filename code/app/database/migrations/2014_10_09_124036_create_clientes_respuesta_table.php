<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesRespuestaTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clientes_respuesta', function (Blueprint $table) {
			$table->increments('id_cliente_respuesta');
			$table->integer('id_cliente')->unsigned();
			$table->datetime('ultima_respuesta')->default('1900-01-01 00:00:00');
			$table->integer('id_estado')->unsigned();
			$table->foreign('id_cliente')->references('id_cliente')->on('clientes');
			$table->foreign('id_estado')->references('id_estado')->on('estados');
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
		Schema::drop('clientes_respuesta');
	}

}
