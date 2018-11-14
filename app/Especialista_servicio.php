<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialista_servicio extends Model
{

  protected $table = 'especialista_servicios';
  public $timestamps=false;

    protected $fillable = ['id_servicio', 'id_especialista', 'id_recinto'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }

    
}
