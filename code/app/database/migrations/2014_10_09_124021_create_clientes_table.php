<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clientes', function (Blueprint $table) {
			$table->increments('id_cliente');
			$table->integer('id_estado')->unsigned();
			$table->foreign('id_estado')->references('id_estado')->on('estados');
			$table->integer('id_alumno')->unsigned();
			$table->foreign('id_alumno')->references('id_alumno')->on('bdd_umayor');
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
		Schema::drop('clientes');
	}

}
