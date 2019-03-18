<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class CorreoCitaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CorreoCitaController
    |--------------------------------------------------------------------------
    | This driver is responsible for handling the appointment reservation email.
    | 
    */
    
    /**
     * @param $email is the email of the patient.
     * @param $name is the name of the patient.
     * @param $fecha date of the appointment.
     * @param $hora time of the appointment.
     */
    public function mail($email, $name, $fecha, $hora)
    {
        Mail::to($email)->send(new SendMailable($name, $fecha, $hora, $recinto, $especialista));
        return view('masterPaciente');
    }
}
