<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRespuestasTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('respuestas', function (Blueprint $table) {
			$table->increments('id_respuesta');
			$table->datetime('fecha')->default('1900-01-01 00:00:00');
			$table->integer('id_estado')->unsigned();
			$table->integer('id_canal')->unsigned();
			$table->integer('id_encuesta')->unsigned();
			$table->integer('id_pregunta')->unsigned();
			$table->integer('id_pregunta_detalle')->unsigned();
			$table->integer('id_cliente')->unsigned();
			$table->integer('id_cliente_respuesta')->unsigned();
			$table->foreign('id_estado')->references('id_estado')->on('estados');
			$table->foreign('id_canal')->references('id_canal')->on('canales');
			$table->foreign('id_encuesta')->references('id_encuesta')->on('encuestas');
			$table->foreign('id_pregunta')->references('id_pregunta')->on('preguntas');
			$table->foreign('id_pregunta_detalle')->references('id_pregunta_detalle')->on('preguntas_detalle');
			$table->foreign('id_cliente')->references('id_cliente')->on('clientes');
			$table->foreign('id_cliente_respuesta')->references('id_cliente_respuesta')->on('clientes_respuesta');
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
		Schema::drop('respuestas');
	}

}
