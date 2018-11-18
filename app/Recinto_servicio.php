<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recinto_servicio extends Model
{
  
  protected $table='recinto_servicios';
  public $timestamps=false;
  protected $fillable = ['recinto_id', 'servicio_id'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
}
