<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecintoModel extends Model
{
    protected $table='recinto';

    protected $primaryKey='ID_Recinto';

    public $timestamps=false;

    protected $fillable= [
    	'Nombre'];

}
