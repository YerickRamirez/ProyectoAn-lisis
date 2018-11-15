<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{

  protected $table = 'citas';

    public $timestamps=false;
    protected $fillable = ['estado_cita_id', 'paciente_id', 'servicio_id', 'especialista_id', 'recinto_id', 'fecha_cita'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }

        public function estado_cita()
        { //para 1-->N, un estado_cita está en N citas
          //          modeloAlQuePertenece      //atributoLocalUsadoParaFK   //atributoTablaPapá (como es id no se pone) 
          return $this->belongsTo('App\Estado_cita', 'estado_cita_id');
        }  

        public function paciente()
        { //para 1-->N, un paciente está en N citas
          //          modeloAlQuePertenece      //atributoLocalUsadoParaFK   //atributoTablaPapá (como es id no se pone) 
          return $this->belongsTo('App\Paciente', 'paciente_id');
        }  

        public function servicio()
        { //para 1-->N, un paciente está en N citas
          //          modeloAlQuePertenece      //atributoLocalUsadoParaFK   //atributoTablaPapá (como es id no se pone) 
          return $this->belongsTo('App\Servicio', 'servicio_id');
        }
}
