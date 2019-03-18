<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarCanceacion;

class CancelacionCitaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CancelacionCitaController
    |--------------------------------------------------------------------------
    | This driver is responsible for handling the cancellation mail for the appointment.
    |
	*/
    
    public function mail($email, $name, $fecha)
{
   Mail::to($email)->send(new EnviarCanceacion($name, $fecha));
   return "Correo enviado exitosamente";
}
}