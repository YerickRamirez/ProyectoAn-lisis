<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarCanceacion;

class CancelacionCitaController extends Controller
{
    
    public function mail($email, $name, $fecha)
{
   Mail::to($email)->send(new EnviarCanceacion($name, $fecha));
   return "Correo enviado exitosamente";
   //return view('masterPaciente');
   //return view('asistente.index');
}
}