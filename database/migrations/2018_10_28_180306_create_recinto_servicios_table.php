<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecintoServiciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recinto_servicios', function(Blueprint $table) {
			$table->integer('servicio_id')->unsigned();
			$table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');

			$table->integer('recinto_id')->unsigned();
			$table->foreign('recinto_id')->references('id')->on('recintos')->onDelete('cascade');
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
		Schema::drop('recinto_servicios');
	}

}
