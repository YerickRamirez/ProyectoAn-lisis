<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTipoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creo un campo apellidos "last_name"
    Schema::table('users', function($table){
        $table->string('tipo',50);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         // Elimino el campo last_name
    Schema::table('users', function ($table) {
        $table->dropColumn('tipo');
    });
    }
}
