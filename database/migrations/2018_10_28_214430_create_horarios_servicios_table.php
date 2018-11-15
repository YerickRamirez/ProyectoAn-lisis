<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosserviciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('horarios_servicios', function(Blueprint $table) {
			
            $table->increments('id');
			$table->integer('id_dia')->unsigned();
			$table->foreign('id_dia')->references('id')->on('dia_horario_servicios')->onDelete('cascade');

			$table->integer('id_recinto')->unsigned();
			$table->foreign('id_recinto')->references('id')->on('recintos')->onDelete('cascade');

			$table->integer('id_servicio')->unsigned();
			$table->foreign('id_servicio')->references('id')->on('servicios')->onDelete('cascade');

			$table->integer('id_especialista')->unsigned();
			$table->foreign('id_especialista')->references('id')->on('especialistas')->onDelete('cascade');

			$table->integer('disponibilidad_manana')->unsigned();
			$table->integer('disponibilidad_tarde')->unsigned();
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
		Schema::drop('horarios_servicios');
	}

}
