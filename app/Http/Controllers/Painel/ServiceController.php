<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    private $service;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = 'img/servicos/';

    public function __construct(Service $service){

        $this->service = $service;
    }

    public function index(){

        $servicos = $this->service->all();

        return view('painel.service.index', ['servicos' => $servicos]);

    }

    public function add(){

        return view('painel.service.add');

    }

    public function create(Request $request){

        $this->validate($request, [
            'titulo' => 'required|max:255',
            'texto' => 'required'
        ]);

        $service = new Service();

        //verifica se foi enviada alguma imagem com o formulário
        if($request->file('imagem')){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $service->imagem = $this->moverImagem($image, $extensao);
        }

        $service->titulo = $request->input('titulo');
        $service->texto = $request->input('texto');

        if($service->save()){
            return redirect('/painel/service')->with('sucesso', 'Serviço cadastrado com sucesso!');
        }else{
            return redirect('/painel/service')->with('erro', 'Erro ao cadastrar o serviço, tente novamente mais tarde!');
        }
        

    }

    public function edit($id){

        return view('painel.service.edit');

    }

    public function update(Request $request){



    }

    public function delete($id){

        $service = $this->service->find($id);

        if($service->delete()){
            return redirect('/painel/service')->with('sucesso', 'Serviço deletado com sucesso!');
        }else{
            return redirect('/painel/service')->with('erro', 'Erro ao deletar o serviço, tente novamente mais tarde!');
        }

    }

    public function moverImagem($image, $extensao){

        if(!in_array($extensao, $this->extensoes)) {
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos jpg, jpeg e png');
        } else {

            $filename = 'servico' . time() . '.' . $extensao;

            $path = public_path($this->caminhoImg . $filename);

            Image::make($image->getRealPath())->resize(282, 210)->save($path);

            return $this->caminhoImg . $filename;

        }

    }

}
