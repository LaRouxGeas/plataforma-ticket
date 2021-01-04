<?php

namespace App\Mail;

use App\Usuarios;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Usuarios $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('plataforma.tickets@gcccontactcenter.com.br')
            ->subject('PTT - Teste de envio de Email')
            ->with(['usuario' => $this->usuario])
            ->view('emails.teste');
    }
}
