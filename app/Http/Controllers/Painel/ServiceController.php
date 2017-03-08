<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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
            'resumo' => 'required|max:130',
            'texto' => 'required'
        ]);

        $servico = new Service();

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('imagem'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $servico->imagem = $this->moverImagem($image, $extensao);
        }

        $servico->titulo = $request->input('titulo');
        $servico->resumo = $request->input('resumo');
        $servico->texto = $request->input('texto');

        if(empty($request->input('status'))) {
            $servico->status = '0';
        }else{
            $servico->status = $request->input('status');
        }

        if($servico->save()){
            return redirect('/painel/service')->with('sucesso', 'Serviço cadastrado com sucesso!');
        }else{
            return redirect('/painel/service')->with('erro', 'Erro ao cadastrar o serviço, tente novamente mais tarde!');
        }
        

    }

    public function edit($id){

        $servico = $this->service->find($id);

        return view('painel.service.edit', ['servico' => $servico]);

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'titulo' => 'required|max:255',
            'resumo' => 'required|max:130',
            'texto' => 'required'
        ]);

        $servico = $this->service->find($id);

        //verifica se foi enviada alguma imagem com o formulário
        if($request->file('imagem')){

            //metodo que verifica se a imagem salva no banco exite no diretorio
            //caso exista remove a mesma do diretorio
            $this->removeImagemDir($servico->imagem);

            //armazena a nova imagem
            $image = $request->file('imagem');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $servico->imagem = $this->moverImagem($image, $extensao);
        }

        $servico->titulo = $request->input('titulo');
        $servico->resumo = $request->input('resumo');
        $servico->texto = $request->input('texto');
        if(empty($request->input('status'))) {
            $servico->status = '0';
        }else{
            $servico->status = $request->input('status');
        }

        if($servico->update()){
            return redirect('/painel/service')->with('sucesso', 'Serviço editado com sucesso!');
        }else{
            return redirect('/painel/service')->with('erro', 'Erro ao editar o serviço, tente novamente mais tarde!');
        }

    }

    public function detail($id){

        $servico = $this->service->find($id);

        return view('painel.service.detail', ['servico' => $servico]);

    }

    public function delete($id){

        $servico = $this->service->find($id);

        if($servico->delete()){

            //metodo que verifica se a imagem salva no banco exite no diretorio
            //caso exista remove a mesma do diretorio
            $this->removeImagemDir($servico->imagem);

            return redirect('/painel/service')->with('sucesso', 'Serviço deletado com sucesso!');
        }else{
            return redirect('/painel/service')->with('erro', 'Erro ao deletar o serviço, tente novamente mais tarde!');
        }

    }

    /*
     * Metodo responsavel por verificar a extensao, redimencionar e mover a imagem para seu destino
     */
    public function moverImagem($image, $extensao){

        if(!in_array($extensao, $this->extensoes)) {
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos jpg, jpeg e png');
        } else {

            $filename = 'servico' . time() . '.' . $extensao;

            $path = public_path($this->caminhoImg . $filename);

            Image::make($image->getRealPath())->resize(242,200)->save($path);

            return $this->caminhoImg . $filename;

        }

    }

    /*
     * Metodo responsavel por verificar se a imagem existe no diretorio e remove-lá
     */
    public function removeImagemDir($imagem){

        //verifica se a foto antiga existe no diretorio
        if(File::exists($imagem)) {
            //remove a foto do diretorio
            File::delete($imagem);
        }

    }

}
