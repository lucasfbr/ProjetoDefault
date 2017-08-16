<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContatoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $email;
    public $telefone;
    public $mensagem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $email, $telefone, $mensagem)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->mensagem = $mensagem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)
                    ->view('portal.email.contato')
                    ->subject('Contato pelo site ' . info_sistem()->titulo ? info_sistem()->titulo : 'de consultoria');

    }
}
