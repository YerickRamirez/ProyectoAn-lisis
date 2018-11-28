<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class confirmarCita extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $fecha;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $fecha)
    {
        $this->name = $name;
        $this->fecha = $fecha;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Correos/confirmarCita')
                ->from('no-reply@nuestrodominio.com.ar')
                ->subject('Cita confirmada');

    }
}