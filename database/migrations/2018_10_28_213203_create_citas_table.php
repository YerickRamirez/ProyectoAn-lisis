<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('citas', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('estado_cita_id')->unsigned();
			$table->foreign('estado_cita_id')->references('id')->on('estado_citas')->onDelete('cascade');
			
			$table->integer('paciente_id')->unsigned();
			$table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
			
			$table->integer('servicio_id')->unsigned();
			$table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');

			$table->integer('especialista_id')->unsigned();
			$table->foreign('especialista_id')->references('id')->on('especialistas')->onDelete('cascade');

			$table->integer('recinto_id')->unsigned();
			$table->foreign('recinto_id')->references('id')->on('recintos')->onDelete('cascade');

            $table->dateTime('fecha_cita');
            $table->boolean('active_flag');
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('citas');
	}

}
