<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recinto extends Model
{

  protected $table='recintos';
  public $timestamps=false;
  protected $fillable = ['descripcion'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }


        public function servicios()
    {   //        modeloQuetengoN  nombreCrossTable //FkMiaCrossTable //FkOtroCrossTable
        return $this->belongsToMany('App\Servicio', 'recinto_servicios', 'recinto_id', 'servicio_id');
    }
    
}
