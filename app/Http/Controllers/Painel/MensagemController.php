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

        dd('chegou');

        $search = $request->input('val');

        $mensagens = $this->mensagem->where('nome', 'like', '%' . $search . '%')->paginate(50);

        return view('painel.mensagem.index', compact('mensagens','search','tipo'));

    }

    public function add(){

        return view('painel.mensagem.add');

    }

    public function read($id){

        $mensagem = $this->mensagem->find($id);

        return view('painel.mensagem.read', compact('mensagem'));

    }

    public function readPrint($id){

        $mensagem = $this->mensagem->find($id);

        return view('painel.mensagem.readPrint', compact('mensagem'));

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

}
