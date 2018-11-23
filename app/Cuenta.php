<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{

  protected $table = 'especialistas';
  public $timestamps=false;
  protected $fillable = ['nombre_usuario', 'contrasenna', 'tipo', 'verificado', 'codigo_verificacion', 'estado_cuenta'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }

        public function especialista()
        {
              //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
              return $this->hasOne('App\EspecialistaModel', 'id_cuenta');
        }

        public function paciente()
        {
              //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
              return $this->hasOne('App\Paciente', 'id_cuenta');
        }
}
