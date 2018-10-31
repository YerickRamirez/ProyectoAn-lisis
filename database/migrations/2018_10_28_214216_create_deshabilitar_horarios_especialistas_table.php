<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeshabilitarhorariosespecialistasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deshabilitar_horarios_especialistas', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_especialista');
            $table->date('fecha_inicio_deshabilitar');
            $table->date('fecha_fin_deshabilitar');
            $table->time('hora_inicio_deshabilitar');
            $table->time('hora_fin_deshabilitar');
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
		Schema::drop('deshabilitar_horarios_especialistas');
	}

}
