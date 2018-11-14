<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deshabilitar_horarios_especialista extends Model
{

  protected $table = 'deshabilitar_horarios_especialistas';
  public $timestamps=false;
  protected $fillable = ['id_especialista', 'fecha_inicio_deshabilitar', 'fecha_fin_deshabilitar', 'hora_inicio_deshabilitar', 'hora_fin_deshabilitar'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }

        public function especialista()
        { //para 1-->N, un especialista tiene N deshab_hroarios
          //          modeloAlQuePertenece      //atributoLocalUsadoParaFK   //atributoTablaPapá (como es id no se pone) 
          return $this->belongsTo('App\EspecialistaModel', 'id_especialista');
        }
}
