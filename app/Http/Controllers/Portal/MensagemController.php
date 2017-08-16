<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use App\Mail\ContatoMail;
use Validator;
use App\Mensagem;

class MensagemController extends Controller
{

    private $mensagem;

    public function __construct(Mensagem $mensagem){

        $this->mensagem = $mensagem;

    }

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
        $cadastro = $this->mensagem->create($request->all());

        if($cadastro){
            return redirect('/#contato')->with('sucesso', 'Mensagem enviada com sucesso, logo entraremos em contato!');
        }else{
            return redirect('/#contato')->with('erro', 'Erro ao enviar a mensagem, tente novamente mais tarde!');
        }
        /*Fim do cadastro da mensagem no banco e redirecionamento*/

    }

    public function sendmail($request, $mailer)
    {

        $mailer->to(usuarioPrincipal()->email)
            ->send(new ContatoMail(
                $request->input('nome'),
                $request->input('email'),
                $request->input('telefone'),
                $request->input('mensagem')
            ));

    }
}
