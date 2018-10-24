<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recinto extends Model
{
    protected $table='recinto';

    protected $primaryKey='ID_Recinto';
    
    protected $fillable = [
      'ID_Recinto', 
      'Nombre'];



}
