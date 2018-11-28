<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class cuentaCreada extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
        //$this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Correos/cuentaCreada')
                ->from('no-reply@nuestrodominio.com.ar')
                ->subject('Cuenta creada exitosamente');

    }
}