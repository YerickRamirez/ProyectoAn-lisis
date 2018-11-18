<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $fecha;
    public $hora;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $fecha, $hora)
    {
        $this->name = $name;
        $this->fecha = $fecha;
        $this->hora = $hora;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Correos/citaReservada')
                ->from('no-reply@nuestrodominio.com.ar')
                ->subject('Verificación cita médica');

    }
}
