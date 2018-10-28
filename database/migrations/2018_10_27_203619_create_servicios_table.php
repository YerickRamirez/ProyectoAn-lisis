<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servicios', function(Blueprint $table) {
            $table->increments('id');
            /*$table->string('name')->default('Un-Named Servicio');
            $table->string('slug');
            $table->text('description');*/
            //$table->string('chema=servicio_id');//Se usa para las fk
            $table->string('nombre');
            $table->string('descripcion');
            $table->boolean('active_flag'); //Es para no borrar la tabla.
            $table->integer('author_id')->unsigned()->default(0);
            $table->foreign('author_id')->references('id')->on('users');
            //$table->timestamps();
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('servicios');
	}

}
