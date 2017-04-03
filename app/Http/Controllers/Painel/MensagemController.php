<?php

namespace App\Http\Controllers\Painel;

use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        return view('painel.mensagem.index', compact('mensagens', 'search'));

    }

    public function search(Request $request){

        $search = $request->input('val');

        $mensagens = $this->mensagem->where('nome','like', '%'.$search.'%')->paginate(50);

        return view('painel.mensagem.index', compact('mensagens','search'));

    }

    public function add(){

        return view('painel.mensagem.add');

    }

    public function read($id){

        return view('painel.mensagem.read');

    }
}
