<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Confirmacion extends Mailable
{
    use Queueable, SerializesModels;

    public $name;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
        //$this->fecha = $fecha;
        //$this->hora = $hora;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      //  return $this->view('view.name');
     // Auth::logout();
      //  return $this->view('auth/login');

        return $this->view('auth/login')
                ->from('no-reply@nuestrodominio.com.ar')
                ->subject('Correo de confirmacion');
    }
}
