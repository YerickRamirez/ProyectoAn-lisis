<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuentas_activa extends Model
{
    protected $fillable = ['cuentas_activas'];

    public function Author(){
      return $this->belongsTo('App\User','author_id');
        }
}
