<?php

namespace App\Http\Controllers\Painel;

use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Mailer;
use App\Mail\RespostaContatoMail;
use App\Mensagem;

class MensagemController extends Controller
{
    private $mensagem;

    public function __construct(Mensagem $mensagem)
    {
        $this->mensagem = $mensagem;
        \Carbon\Carbon::setLocale('pt_BR');
    }

    public function index(){

        $search = '';
        $mensagens = $this->mensagem->paginate(50);

        $totalMensagens = $this->totalMensagens();
        $totalLixeira = $this->totalLixeira();

        return view('painel.mensagem.index', compact('mensagens', 'search', 'totalMensagens', 'totalLixeira'));

    }

    public function search(Request $request){

        $search = $request->input('val');

        $mensagens = $this->mensagem->where('nome', 'like', '%' . $search . '%')->paginate(50);

        $totalMensagens = $this->totalMensagens();
        $totalLixeira = $this->totalLixeira();

        return view('painel.mensagem.index', compact('mensagens','search', 'totalMensagens', 'totalLixeira'));

    }

    public function add(){

        return view('painel.mensagem.add');

    }

    public function read($id){

        $mensagem = $this->mensagem->find($id);

        $totalMensagens = $this->totalMensagens();
        $totalLixeira = $this->totalLixeira();

        return view('painel.mensagem.read', compact('mensagem','totalMensagens','totalLixeira'));

    }

    public function readPrint($id){

        $mensagem = $this->mensagem->find($id);

        return view('painel.mensagem.readPrint', compact('mensagem'));

    }

    public function resposta(Request $request, Mailer $mailer, $id){

        $mensagem = $this->mensagem->find($id);

        $resposta = $request->input('resposta');

        if($resposta){


            //enviando email com a mensagem do cliente para o administrador do sistema
            if(usuarioPrincipal()->name AND usuarioPrincipal()->email) {
                $this->sendmail($request, $mailer);

                $mensagem->resposta = $resposta;
                $mensagem->update();

            }else{
                return redirect('/painel/mensagem/read/'.$id)->with('erro', 'Somente o usuario principal poderá responder uma mensagem, defina seu usuario como tal para poder enviar uma resposta!');
            }

        }

        return redirect('/painel/mensagem/read/'.$id);

    }

    public function delete($ids){

        $array = explode(',', $ids);

        $msg = new Mensagem;

        if($msg->destroy($array)){

            return response()->json(true);

        }else{

            return response()->json(false);

        }

    }

    public function trash(){

        $search = '';
        $mensagens = $this->mensagem->onlyTrashed()->paginate(50);

        $totalMensagens = $this->totalMensagens();
        $totalLixeira = $this->totalLixeira();

        return view('painel.mensagem.trash', compact('mensagens', 'search', 'totalMensagens', 'totalLixeira'));

    }

    public function searchTrash(Request $request){

        $search = $request->input('val');

        $mensagens = $this->mensagem->onlyTrashed()->where('nome', 'like', '%' . $search . '%')->paginate(50);

        $totalMensagens = $this->totalMensagens();
        $totalLixeira = $this->totalLixeira();

        return view('painel.mensagem.trash', compact('mensagens','search', 'totalMensagens', 'totalLixeira'));

    }

    public function destroy($id){

        $array = explode(',', $id);

        $msg = new Mensagem;

        if($msg->whereIn('id', $array)->forceDelete()){

            return response()->json(true);

        }else{

            return response()->json(false);

        }

    }

    public function restore($id){

        $array = explode(',', $id);

        $msg = new Mensagem;

        if($msg->whereIn('id', $array)->restore()){

            return response()->json(true);

        }else{

            return response()->json(false);

        }

    }

    //Enviar email de resposta para o cliente
    public function sendmail($request, $mailer)
    {

        $mailer->to($request->input('email'))
            ->send(new RespostaContatoMail(
                $request->input('nome'),
                $request->input('email'),
                $request->input('telefone'),
                $request->input('mensagem'),
                usuarioPrincipal()->name,
                usuarioPrincipal()->email,
                $request->input('resposta')
            ));

    }

    public function totalMensagens(){

        return $totalMensagens = $this->mensagem->all()->count();

    }

    public function totalLixeira(){

        return $this->mensagem->onlyTrashed()->count();

    }

}
