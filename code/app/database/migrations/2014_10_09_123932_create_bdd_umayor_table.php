<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBddUmayorTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bdd_umayor', function (Blueprint $table) {
			$table->increments('id_alumno');
			$table->string('facultad');
			$table->string('escuela');
			$table->string('carrera');
			$table->string('jornada');
			$table->string('sede');
			$table->string('campus');
			$table->string('rut', 11);
			$table->string('apellido_paterno');
			$table->string('apellido_materno');
			$table->string('nombres');
			$table->char('sexo', 1);
			$table->integer('año_ingreso_1año_carrera');
			$table->integer('año_ingreso_carrera')->nullable();
			$table->integer('año_egreso_plan_regular')->nullable();
			$table->datetime('fecha_registro')->default('1900-01-01 00:00:00');
			$table->index('rut');
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
		Schema::drop('bdd_umayor');
	}

}
