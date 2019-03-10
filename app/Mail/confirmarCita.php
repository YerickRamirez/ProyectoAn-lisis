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
    public $hora;
    public $recinto;
    public $especialista;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $fecha, $hora,  $recinto, $especialista)
    {
        $this->name = $name;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->recinto = $recinto;
        $this->especialista = $especialista;
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
                ->subject('Cita médica confirmada');

    }
}