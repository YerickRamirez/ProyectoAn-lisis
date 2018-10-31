<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pacientes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cuenta');
            $table->string('cedula_paciente', 30);
            $table->string('nombre', 60);
            $table->string('primer_apellido_paciente', 45);
            $table->string('segundo_apellido_paciente', 45);
            $table->boolean('estado');
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
		Schema::drop('pacientes');
	}

}
