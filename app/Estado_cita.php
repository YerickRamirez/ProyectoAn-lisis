<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_cita extends Model
{

  protected $table='estado_citas';

  public $timestamps=false;

    protected $fillable = ['descripcion_estado_cita'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }

        public function citas()
        {
          //          modeloDelCualTieneN      //atributoForáneoUsadoParaFK   //PK_local (como es id no se pone)
          return $this->hasMany('App\Cita', 'estado_cita_id');
        }
}
