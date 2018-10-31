<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloqueo_especialistum extends Model
{

    protected $table = 'bloqueo_especialistas';

    public $timestamps=false;

    protected $fillable = ['id_especialista', 'id_dia_bloqueo_especialistas', 'fecha_inicio_bloqueo_especialista', 'fecha_fin_bloqueo_especialista', 'hora_inicio_bloqueo_especialista', 'hora_fin_bloqueo_especialista'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }

        public function especialista()
        { //para 1-->N, un especialista tiene N bloqueos
          //          modeloAlQuePertenece      //atributoLocalUsadoParaFK   //atributoTablaPapá (como es id no se pone) 
          return $this->belongsTo('App\EspecialistaModel', 'id_especialista');
        }

        public function dia()
        { //para 1-->N, un dia tiene N bloqueos
          //          modeloAlQuePertenece      //atributoLocalUsadoParaFK   //atributoTablaPapá (como es id no se pone) 
          return $this->belongsTo('App\Dia_bloqueo_especialista', 'id_dia_bloqueo_especialistas');
        }
}
