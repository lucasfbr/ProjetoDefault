<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Support\Facades\Gate;
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

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Visualizar o index
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('view_services'))
            return redirect()->back()->with('erro', 'Você não tem permissão de acesso à página SERVIÇOS, entre em contato com o administrador do site!');

        $servicos = $this->service->all();

        return view('painel.service.index', ['servicos' => $servicos]);

    }

    public function add(){

        /*
        * PERMISSÃO DO USUÁRIO
        *
        * Visualizar formulario para add servico
        *
        * verifica a permissão do usuário
        * se usuario autorizado segue o código, caso contrário retorna para página anterior
        */
        if(Gate::denies('add_service'))
            return redirect()->back()->with('erro', 'Você não tem permissão para adicionar um novo registro, entre em contato com o administrador do site!');

        return view('painel.service.add');

    }

    public function create(Request $request){

        /*
       * PERMISSÃO DO USUÁRIO
       *
       * Criar um novo serviço
       *
       * verifica a permissão do usuário
       * se usuario autorizado segue o código, caso contrário retorna para página anterior
       */
        if(Gate::denies('create_service'))
            return redirect()->back()->with('erro', 'Você não tem permissão para criar um novo registro, entre em contato com o administrador do site!');


        $this->validate($request, [
            'titulo' => 'required|max:255',
            'resumo' => 'required|max:130',
            'texto' => 'required'
        ]);

        $servico = new Service();

        //verifica se foi enviada a imagem destacada
        if(!empty($request->file('imagem'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //envia para o metodo moverImagem a imagem, a extensao e um parametro
            //neste caso 0 que representa a imagem a ser redimencionada para o
            //thumbnail
            $servico->imagem = $this->moverImagem($image, $extensao, 0);
        }

        //verifica se foi enviada a imagem para descricao
        if(!empty($request->file('imagem_descricao'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem_descricao');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //envia para o metodo moverImagem a imagem, a extensao e um parametro
            //neste caso 1 que representa a imagem no tamanho original
            $servico->imagem_descricao = $this->moverImagem($image, $extensao, 1);
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

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Visualizar formulário de edição
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('edit_service'))
            return redirect()->back()->with('erro', 'Você não tem permissão para editar este registro, entre em contato com o administrador do site!');

        $servico = $this->service->find($id);

        return view('painel.service.edit', ['servico' => $servico]);

    }

    public function update(Request $request, $id){

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Editar informações do registro
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('update_service'))
            return redirect()->back()->with('erro', 'Você não tem permissão para Atualizar este registro, entre em contato com o administrador do site!');

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
            $servico->imagem = $this->moverImagem($image, $extensao, 0);
        }

        //verifica se foi enviada a imagem para descricao
        if($request->file('imagem_descricao')){

            //metodo que verifica se a imagem salva no banco existe no diretorio
            //caso exista remove a mesma do diretorio
            //$this->removeImagemDir($servico->imagem_descricao);

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem_descricao');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //envia para o metodo moverImagem a imagem, a extensao e um parametro
            //neste caso 1 que representa a imagem no tamanho original
            $servico->imagem_descricao = $this->moverImagem($image, $extensao, 1);
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

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Visualizar os detalhes do registro
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('detail_service'))
            return redirect()->back()->with('erro', 'Você não tem permissão para visualizar este registro, entre em contato com o administrador do site!');

        $servico = $this->service->find($id);

        $todosServicos = $this->service->all();

        return view('painel.service.detail', ['servico' => $servico, 'todosServicos' => $todosServicos]);

    }

    public function delete($id){

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Deletar registro
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('delete_service'))
            return redirect()->back()->with('erro', 'Você não tem permissão para deletar este registro, entre em contato com o administrador do site!');

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
    public function moverImagem($image, $extensao, $tipo){

        if(!in_array($extensao, $this->extensoes)) {
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos jpg, jpeg e png');
        } else {

            $filename = 'servico' . time() . '.' . $extensao;

            $path = public_path($this->caminhoImg . $filename);

            //se tipo for igual 0, deve ser redimencionada
            //se tipo for igual 1, salva a imagem original
            if($tipo == 0) {
                Image::make($image->getRealPath())->resize(242, 200)->save($path);
            }else{
                Image::make($image->getRealPath())->resize(1024, 580)->save($path);
            }

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
