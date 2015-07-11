<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePreguntasTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preguntas', function (Blueprint $table) {
			$table->increments('id_pregunta');
			$table->string('descripcion_1');
			$table->string('descripcion_2')->nullable();
			$table->string('descripcion_3')->nullable();
			$table->string('numero_pregunta');
			$table->integer('id_pregunta_padre')->nullable();
			$table->integer('id_tipo_respuesta')->unsigned();
			$table->foreign('id_tipo_respuesta')->references('id_tipo_respuesta')->on('tipos_respuesta');
			$table->integer('id_estado')->unsigned();
			$table->foreign('id_estado')->references('id_estado')->on('estados');
			$table->integer('id_encuesta')->unsigned();
			$table->foreign('id_encuesta')->references('id_encuesta')->on('encuestas');
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
		Schema::drop('preguntas');
	}

}
