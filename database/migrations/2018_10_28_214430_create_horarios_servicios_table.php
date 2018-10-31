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
            $table->integer('id_dia');
            $table->integer('id_servicio');
            $table->integer('id_especialista');
            $table->date('fecha_inicio_servicio');
            $table->date('fecha_fin_servicio');
            $table->time('hora_inicio_servicio');
            $table->time('hora_fin_servicio');
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
