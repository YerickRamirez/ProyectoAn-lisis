<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{

  protected $table='servicios';
  public $timestamps=false;
  protected $fillable = ['id', 'nombre', 'descripcion'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }

        public function citas()
        {
          //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
          return $this->hasMany('App\Cita', 'servicio_id');
        }

        public function especialistas()
    {   //        modeloQuetengoN  nombreCrossTable //FkMiaCrossTable //FkOtroCrossTable
        return $this->belongsToMany('App\EspecialistaModel', 'especialista_servicios', 'id_servicio', 'id_especialista');
    }

    public function horarios_servicios()
        {
          //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
          return $this->hasMany('App\Horarios_servicio', 'id_servicio');
        }

        public function recintos()
        {   //        modeloQuetengoN  nombreCrossTable //FkMiaCrossTable //FkOtroCrossTable
            return $this->belongsToMany('App\Recinto', 'recinto_servicios', 'servicio_id', 'recinto_id');
        }
}
