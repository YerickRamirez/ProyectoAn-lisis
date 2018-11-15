<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telefonos', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('paciente_id')->unsigned();
			$table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->integer('telefono');
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
		Schema::drop('telefonos');
	}

}
