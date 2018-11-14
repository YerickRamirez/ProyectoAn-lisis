<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horarios_servicio extends Model
{

  protected $table='horarios_servicios';
  public $timestamps=false;
  protected $fillable = ['id_dia', 'id_servicio', 'id_especialista', 'fecha_inicio_servicio', 'fecha_fin_servicio', 'hora_inicio_servicio', 'hora_fin_servicio', 'id_recinto'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }

        public function dia()
        { //para 1-->N, un paciente tiene N correos
          //          modeloAlQuePertenece      //atributoLocalUsadoParaFK   //atributoTablaPapá (como es id no se pone) 
          return $this->belongsTo('App\Dia_horario_servicio', 'id_dia');
        }


        /************************************** especialistas y servicios es de una cross */
        public function especialistas()
        { //para 1-->N, un paciente tiene N correos
          //          modeloAlQuePertenece      //atributoLocalUsadoParaFK   //atributoTablaPapá (como es id no se pone) 
          return $this->belongsTo('App\EspecialistaModel', 'id_especialista');
        }

        public function servicios()
        { //para 1-->N, un paciente tiene N correos
          //          modeloAlQuePertenece      //atributoLocalUsadoParaFK   //atributoTablaPapá (como es id no se pone) 
          return $this->belongsTo('App\Servicio', 'id_servicio');
        }

}
