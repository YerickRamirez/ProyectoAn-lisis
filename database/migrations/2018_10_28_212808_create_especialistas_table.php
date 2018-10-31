<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialistasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('especialistas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('cedula_especialista', 30);
            $table->integer('id_cuenta');
            $table->string('nombre', 50);
            $table->string('primer_apellido_especialista', 45);
            $table->string('segundo_apellido_especialista', 45);
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
		Schema::drop('especialistas');
	}

}
