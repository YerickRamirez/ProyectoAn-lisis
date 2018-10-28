<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [/*'chema=servicio_id', */'nombre', 'descripcion'];
      public $timestamps=false;

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
}
