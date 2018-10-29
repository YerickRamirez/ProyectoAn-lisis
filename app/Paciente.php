<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{

  protected $table='pacientes';
  public $timestamps=false;

    protected $fillable = ['id_cuenta', 'cedula_paciente', 'nombre', 'primer_apellido_paciente', 'segundo_apellido_paciente', 'estado'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }

        public function citas()
        {
          //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
          return $this->hasMany('App\Cita', 'paciente_id');
        }

        public function correos()
        {
          //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
          return $this->hasMany('App\Correo', 'paciente_id');
        }

        public function telefonos()
        {
          //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
          return $this->hasMany('App\Telefono', 'paciente_id');
        }

        public function cuenta()
        { //para 1-->N, un paciente tiene N correos
          //          modeloAlQuePertenece      //atributoLocalUsadoParaFK   //atributoTablaPapá (como es id no se pone) 
          return $this->belongsTo('App\Cuenta', 'id_cuenta');
        }
}
