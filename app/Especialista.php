<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    //protected $fillable = ['cedula_especialista', /*'nombre_usuario', */'nombre', 'primer_apellido_especialista', 'segundo_apellido_especialista', 'active_flag'];
    protected $table='especialistas';

    public $timestamps=false;

    protected $fillable = ['cedula_especialista', 'nombre', 'primer_apellido_especialista', 'segundo_apellido_especialista', 'estado'];

    public function bloqueo_horario()
    {
      //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
      return $this->hasMany('App\Bloqueo_especialistum', 'id_especialista');
    }


    public function horario_deshabilitado()
        {
          //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
          return $this->hasMany('App\Deshabilitar_horarios_especialista', 'id_especialista');
        }
    
        public function servicios()
    {   //        modeloQuetengoN  nombreCrossTable //FkMiaCrossTable //FkOtroCrossTable
        return $this->belongsToMany('App\Servicio', 'especialista_servicios', 'id_especialista', 'id_servicio');
    }

    public function cuenta()
        { //para 1-->N, un paciente tiene N correos
          //          modeloAlQuePertenece      //atributoLocalUsadoParaFK   //atributoTablaPapá (como es id no se pone) 
          return $this->belongsTo('App\Cuenta', 'id_cuenta');
        }

        public function horarios_administrativos()
        {
          //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
          return $this->hasMany('App\Horarios_administrativo', 'id_especialista');
        }

        public function horarios_servicios()
        {
          //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
          return $this->hasMany('App\Horarios_servicio', 'id_especialista');
        }
}
