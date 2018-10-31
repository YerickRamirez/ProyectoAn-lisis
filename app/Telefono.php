<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{

  protected $table='telefonos';
  public $timestamps=false;
  protected $fillable = ['paciente_id', 'telefono'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }

        public function paciente()
        { //para 1-->N, un paciente tiene N correos
          //          modeloAlQuePertenece      //atributoLocalUsadoParaFK   //atributoTablaPapá (como es id no se pone) 
          return $this->belongsTo('App\Paciente', 'paciente_id');
        }
}
