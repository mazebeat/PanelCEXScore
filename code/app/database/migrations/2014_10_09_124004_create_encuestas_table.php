<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEncuestasTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('encuestas', function (Blueprint $table) {
			$table->increments('id_encuesta');
			$table->string('titulo');
			$table->datetime('fecha_creacion')->default('1900-01-01 00:00:00');
			$table->datetime('fecha_modificacion')->default('1900-01-01 00:00:00');
			$table->integer('id_estado')->unsigned();
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
		Schema::drop('encuestas');
	}

}
