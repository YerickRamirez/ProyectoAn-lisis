<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloqueoespecialistasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bloqueo_especialistas', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('id_especialista')->unsigned();
			$table->foreign('id_especialista')->references('id')->on('especialistas')->onDelete('cascade');
			
			$table->integer('id_dia_bloqueo_especialistas')->unsigned();
			$table->foreign('id_dia_bloqueo_especialistas')->references('id')->on('dia_bloqueo_especialistas')->onDelete('cascade');

            $table->date('fecha_inicio_bloqueo_especialista');
            $table->date('fecha_fin_bloqueo_especialista');
            $table->time('hora_inicio_bloqueo_especialista');
            $table->time('hora_fin_bloqueo_especialista');
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
		Schema::drop('bloqueo_especialistas');
	}

}
