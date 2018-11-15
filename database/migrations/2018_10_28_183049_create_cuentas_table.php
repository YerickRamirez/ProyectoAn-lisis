<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cuentas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_usuario', 40)->unique();
            $table->string('contrasenna', 40);
            $table->string('tipo', 20);
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
		Schema::drop('cuentas');
	}

}
