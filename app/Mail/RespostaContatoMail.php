<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RespostaContatoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $email;
    public $telefone;
    public $mensagem;
    public $emailModerador;
    public $moderador;
    public $resposta;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $email, $telefone, $mensagem, $moderador, $emailModerador, $resposta)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->mensagem = $mensagem;
        $this->emailModerador = $emailModerador;
        $this->moderador = $moderador;
        $this->resposta = $resposta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from($this->emailModerador)
                    ->view('painel.email.respostaContato')
                    ->subject('Resposta enviada pelo site ' . info_sistem()->titulo ? info_sistem()->titulo : 'de consultoria');

    }
}
