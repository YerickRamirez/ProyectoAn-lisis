<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dia_bloqueo_especialista extends Model
{

  protected $table = 'dia_bloqueo_especialistas';
  public $timestamps=false;
  protected $fillable = ['dia'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }

        public function bloqueo_especialistas()
        {
          //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
          return $this->hasMany('App\Bloqueo_especialistum', 'id_dia_bloqueo_especialistas');
        }
    
}
