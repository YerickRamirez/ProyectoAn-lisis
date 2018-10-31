<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    protected $fillable = ['cedula_especialista', 'nombre_usuario', 'nombre', 'primer_apellido_especialista', 'segundo_apellido_especialista', 'estado'];
    public $timestamps=false;

    protected $table='especialistas';

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
}
