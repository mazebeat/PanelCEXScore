<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePreguntasDetalleTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preguntas_detalle', function (Blueprint $table) {
			$table->increments('id_pregunta_detalle');
			$table->string('descripcion');
			$table->datetime('fecha_creacion')->default('1900-01-01 00:00:00');
			$table->datetime('fecha_modificacion')->default('1900-01-01 00:00:00');
			$table->integer('id_estado')->unsigned();
			$table->foreign('id_estado')->references('id_estado')->on('estados');
			$table->integer('id_encuesta')->unsigned();
			$table->foreign('id_encuesta')->references('id_encuesta')->on('encuestas');
			$table->integer('id_pregunta')->unsigned();
			$table->foreign('id_pregunta')->references('id_pregunta')->on('preguntas');
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
		Schema::drop('preguntas_detalle');
	}

}
