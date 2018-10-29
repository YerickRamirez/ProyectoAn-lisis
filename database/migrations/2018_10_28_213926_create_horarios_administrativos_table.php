<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosadministrativosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('horarios_administrativos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_especialista');
            $table->string('dia_administrativo', 30);
            $table->string('horario_administrativo', 45);
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
		Schema::drop('horarios_administrativos');
	}

}
