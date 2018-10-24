<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class CorreoCitaController extends Controller
{
    
    public function mail($email, $name, $fecha, $hora)
{
  
   Mail::to($email)->send(new SendMailable($name, $fecha, $hora));
   
   return view('masterPatient');
}
}
