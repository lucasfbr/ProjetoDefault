<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quemsomos;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;



class QuemsomosController extends Controller
{

    private $quemsomos;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = 'img/quemsomos/';

    public function __construct(Quemsomos $quemsomos){

        $this->quemsomos = $quemsomos;
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
        if(Gate::denies('view_quemsomos'))
            return redirect()->back()->with('erro', 'Você não tem permissão para de acesso à página QUEM SOMOS, entre em contato com o administrador do site!');

        $quemsomos = $this->quemsomos->all();

        return view('painel.quemsomos.index', ['quemsomos' => $quemsomos]);

    }

    public function add(){

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Visualizar formulário de cadastro
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('add_quemsomos'))
            return redirect()->back()->with('erro', 'Você não tem permissão para adicionar um novo registro, entre em contato com o administrador do site!');

        return view('painel.quemsomos.add');

    }

    public function create(Request $request){

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Cadastrar a informação
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('create_quemsomos'))
            return redirect()->back()->with('erro', 'Você não tem permissão para criar um novo registro, entre em contato com o administrador do site!');

        $this->validate($request, [
            'titulo_sobre' => 'required|max:255',
            'texto_sobre' => 'required',
            'titulo_missao' => 'required|max:255',
            'texto_missao' => 'required'
        ]);

        $quemsomos = new quemsomos();

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('imagem_sobre'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem_sobre');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $quemsomos->imagem_sobre = $this->moverImagem($image, $extensao);
        }

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('imagem_missao'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem_missao');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $quemsomos->imagem_missao = $this->moverImagem($image, $extensao);
        }

        $quemsomos->titulo_sobre = $request->input('titulo_sobre');
        $quemsomos->texto_sobre = $request->input('texto_sobre');
        $quemsomos->titulo_missao = $request->input('titulo_missao');
        $quemsomos->texto_missao = $request->input('texto_missao');

        if(empty($request->input('status'))) {
            $quemsomos->status = '0';
        }else{
            $quemsomos->status = $request->input('status');
        }

        if($quemsomos->save()){
            return redirect('/painel/quemsomos')->with('sucesso', 'quemsomos cadastrado com sucesso!');
        }else{
            return redirect('/painel/quemsomos')->with('erro', 'Erro ao cadastrar o quemsomos, tente novamente mais tarde!');
        }


    }

    public function edit($id){

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Visualizar o formulário de edição
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('edit_quemsomos'))
            return redirect()->back()->with('erro', 'Você não tem permissão para editar este registro, entre em contato com o administrador do site!');;

        $quemsomos = $this->quemsomos->find($id);

        return view('painel.quemsomos.edit', ['quemsomos' => $quemsomos]);

    }

    public function update(Request $request, $id){

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Atualizar a informação
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('update_quemsomos'))
            return redirect()->back()->with('erro', 'Você não tem permissão para editar este registro, entre em contato com o administrador do site!');

        $this->validate($request, [
            'titulo_sobre' => 'required|max:255',
            'texto_sobre' => 'required',
            'titulo_missao' => 'required|max:255',
            'texto_missao' => 'required'
        ]);

        $quemsomos = $this->quemsomos->find($id);

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('imagem_sobre'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem_sobre');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $quemsomos->imagem_sobre = $this->moverImagem($image, $extensao);
        }

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('imagem_missao'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem_missao');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $quemsomos->imagem_missao = $this->moverImagem($image, $extensao);
        }

        $quemsomos->titulo_sobre = $request->input('titulo_sobre');
        $quemsomos->texto_sobre = $request->input('texto_sobre');
        $quemsomos->titulo_missao = $request->input('titulo_missao');
        $quemsomos->texto_missao = $request->input('texto_missao');

        if(empty($request->input('status'))) {
            $quemsomos->status = '0';
        }else{
            $quemsomos->status = $request->input('status');
        }

        if($quemsomos->update()){
            return redirect('/painel/quemsomos')->with('sucesso', 'quemsomos editado com sucesso!');
        }else{
            return redirect('/painel/quemsomos')->with('erro', 'Erro ao editar o quemsomos, tente novamente mais tarde!');
        }

    }

    public function detail($id){

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Visualizar os detalhes
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('detail_quemsomos'))
            return redirect()->back()->with('erro', 'Você não tem permissão para visualizar este registro, entre em contato com o administrador do site!');

        $quemsomos = $this->quemsomos->find($id);

        return view('painel.quemsomos.detail', ['quemsomos' => $quemsomos]);

    }

    public function delete($id){

        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Deletar a informação
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('delete_quemsomos'))
            return redirect()->back()->with('erro', 'Você não tem permissão para deletar este registro, entre em contato com o administrador do site!');

        $quemsomos = $this->quemsomos->find($id);

        if($quemsomos->delete()){

            //metodo que verifica se a imagem salva no banco exite no diretorio
            //caso exista remove a mesma do diretorio
            $this->removeImagemDir($quemsomos->imagem);

            return redirect('/painel/quemsomos')->with('sucesso', 'quemsomos deletado com sucesso!');
        }else{
            return redirect('/painel/quemsomos')->with('erro', 'Erro ao deletar o quemsomos, tente novamente mais tarde!');
        }

    }

    /*
     * Metodo responsavel por verificar a extensao, redimencionar e mover a imagem para seu destino
     */
    public function moverImagem($image, $extensao){

        if(!in_array($extensao, $this->extensoes)) {
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos jpg, jpeg e png');
        } else {

            $filename = 'quemsomos' . time() . '.' . $extensao;

            $path = public_path($this->caminhoImg . $filename);

            Image::make($image->getRealPath())->resize(200,200)->save($path);

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
