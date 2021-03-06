<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class recuperarContrasenna extends Mailable
{
    use Queueable, SerializesModels;

    public $random;
    public $nombre;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($random, $nombre)
    {
        $this->random = $random;
        $this->nombre = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Correos/reestablecerContrasenna')
                ->from('no-reply@nuestrodominio.com.ar')
                ->subject('Reestablecer contraseña');

    }
}