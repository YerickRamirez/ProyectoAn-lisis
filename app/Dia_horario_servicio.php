<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dia_horario_servicio extends Model
{

  protected $table = 'dia_horario_servicios';
  public $timestamps=false;

  protected $fillable = ['dia'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }

        public function horario_servicio()
        {
          //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
          return $this->hasMany('App\Horarios_servicio', 'id_dia');
        }
}
