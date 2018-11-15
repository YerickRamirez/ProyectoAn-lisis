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
			$table->integer('id_especialista')->unsigned();
			$table->foreign('id_especialista')->references('id')->on('especialistas')->onDelete('cascade');
			
			$table->integer('id_recinto')->unsigned();
			$table->foreign('id_recinto')->references('id')->on('recintos')->onDelete('cascade');
			
			$table->integer('id_servicio')->unsigned();
			$table->foreign('id_servicio')->references('id')->on('servicios')->onDelete('cascade');
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
