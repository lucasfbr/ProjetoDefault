<?php

namespace App\Http\Controllers\Painel;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
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

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Visualizar o index
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('view_mensagens'))
            return redirect()->back()->with('erro', 'Você não tem permissão de acesso à página MENSAGENS, entre em contato com o administrador do site!');

        $search = '';
        $mensagens = $this->mensagem->orderBy('created_at', 'desc')->paginate(50);

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

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Visualizar o formulário de add
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('add_mensagens'))
            return redirect()->back()->with('erro', 'Você não tem permissão para adicionar mensagens, entre em contato com o administrador do site!');

        return view('painel.mensagem.add');

    }

    public function read($id){

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Ler mensagens
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('read_mensagens'))
            return redirect()->back()->with('erro', 'Você não tem permissão para ler mensagens, entre em contato com o administrador do site!');

        $mensagem = $this->mensagem->find($id);

        $totalMensagens = $this->totalMensagens();
        $totalLixeira = $this->totalLixeira();

        return view('painel.mensagem.read', compact('mensagem','totalMensagens','totalLixeira'));

    }

    public function readPrint($id){

        /*
        * PERMISSÃO DO USUÁRIO
        *
        * Print mensagens
        *
        * verifica a permissão do usuário
        * se usuario autorizado segue o código, caso contrário retorna para página anterior
        */
        if(Gate::denies('print_mensagens'))
            return redirect()->back()->with('erro', 'Você não tem permissão para imprimir mensagens, entre em contato com o administrador do site!');

        $mensagem = $this->mensagem->find($id);

        return view('painel.mensagem.readPrint', compact('mensagem'));

    }

    public function resposta(Request $request, Mailer $mailer, $id){


        /*
        * PERMISSÃO DO USUÁRIO
        *
        * Responder mensagens
        *
        * verifica a permissão do usuário
        * se usuario autorizado segue o código, caso contrário retorna para página anterior
        */
        if(Gate::denies('responder_mensagens'))
            return redirect()->back()->with('erro', 'Você não tem permissão para responder mensagens, entre em contato com o administrador do site!');


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

        /*
       * PERMISSÃO DO USUÁRIO
       *
       * Deletar mensagens
       *
       * verifica a permissão do usuário
       * se usuario autorizado segue o código, caso contrário retorna para página anterior
       */
        if(Gate::denies('deletar_mensagens'))
            return redirect()->back()->with('erro', 'Você não tem permissão para deletar mensagens, entre em contato com o administrador do site!');

        $array = explode(',', $ids);

        $msg = new Mensagem;

        if($msg->destroy($array)){

            return response()->json(true);

        }else{

            return response()->json(false);

        }

    }

    public function trash(){

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Lixeira mensagens
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('lixeira_mensagens'))
            return redirect()->back()->with('erro', 'Você não tem permissão para enviar mensagens para a lixeira, entre em contato com o administrador do site!');


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

        /*
        * PERMISSÃO DO USUÁRIO
        *
        * Apagar da lixeira
        *
        * verifica a permissão do usuário
        * se usuario autorizado segue o código, caso contrário retorna para página anterior
        */
        if(Gate::denies('limpar_lixeira_mensagens'))
            return redirect()->back()->with('erro', 'Você não tem permissão de limpar a lixeira, entre em contato com o administrador do site!');

        $array = explode(',', $id);

        $msg = new Mensagem;

        if($msg->whereIn('id', $array)->forceDelete()){

            return response()->json(true);

        }else{

            return response()->json(false);

        }

    }

    public function restore($id){

        /*
       * PERMISSÃO DO USUÁRIO
       *
       * Restaurar da lixeira
       *
       * verifica a permissão do usuário
       * se usuario autorizado segue o código, caso contrário retorna para página anterior
       */
        if(Gate::denies('restore_mensagens'))
            return redirect()->back()->with('erro', 'Você não tem permissão de restaurar mensagens, entre em contato com o administrador do site!');

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

        /*
      * PERMISSÃO DO USUÁRIO
      *
      * Enviar mensgem
      *
      * verifica a permissão do usuário
      * se usuario autorizado segue o código, caso contrário retorna para página anterior
      */
        if(Gate::denies('enviar_mensagens'))
            return redirect()->back()->with('erro', 'Você não tem permissão para enviar mensagens, entre em contato com o administrador do site!');

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
