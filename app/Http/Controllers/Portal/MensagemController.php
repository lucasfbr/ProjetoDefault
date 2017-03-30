<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use App\Mail\ContatoMail;
use Validator;

class MensagemController extends Controller
{

    public function create(Request $request, Mailer $mailer)
    {

        $validator = Validator::make($request->all(),[
            'nome'     => 'required',
            'email'    => 'required|email',
            'mensagem' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/#contato')
                ->withErrors($validator)
                ->withInput();
        }

        //enviando email com a mensagem do cliente para o administrador do sistema
        $this->sendmail($request, $mailer);

        /*Inicio do cadastro da mensagem no banco e redirecionamento*/

        /*Fim do cadastro da mensagem no banco e redirecionamento*/

    }

    public function sendmail($request, $mailer)
    {

        $mailer->to('lucasfbr03@gmail.com')
            ->send(new ContatoMail(
                $request->input('nome'),
                $request->input('email'),
                $request->input('telefone'),
                $request->input('mensagem')
            ));

    }
}
