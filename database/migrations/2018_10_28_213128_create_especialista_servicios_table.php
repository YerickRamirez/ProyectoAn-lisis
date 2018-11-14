<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialistaserviciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('especialista_servicios', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('id_especialista');
			$table->integer('id_recinto');
			$table->integer('id_servicio');
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
		Schema::drop('especialista_servicios');
	}

}
