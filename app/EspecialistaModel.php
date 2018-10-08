<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspecialistaModel extends Model
{
    protected $table='especialista';

    protected $primaryKey='Cédula';

    public $timestamps=false;

    protected $fillable= [
    	'Cédula',
    	'Nombre',
        'Primer_Apellido',
        'Segundo_Apellido'];

}
