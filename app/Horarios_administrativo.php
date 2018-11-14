<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horarios_administrativo extends Model
{

  protected $table='horarios_administrativos';
  public $timestamps=false;
  protected $fillable = ['id_especialista', 'dia_administrativo', 'horario_administrativo'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }

        public function especialista()
        { //para 1-->N, un paciente tiene N correos
          //          modeloAlQuePertenece      //atributoLocalUsadoParaFK   //atributoTablaPapá (como es id no se pone) 
          return $this->belongsTo('App\EspecialistaModel', 'id_especialista');
        }
}
