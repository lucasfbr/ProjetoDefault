<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Portifolio;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


class PortifolioController extends Controller
{

    private $portifolio;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = 'img/portifolio/';

    public function __construct(Portifolio $portifolio){

        $this->portifolio = $portifolio;

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
        if(Gate::denies('view_portifolio'))
            return redirect()->back()->with('erro', 'Você não tem permissão para de acesso à página PORTIFÓLIO, entre em contato com o administrador do site!');

        $portifolio = $this->portifolio->all();

        return view('painel.portifolio.index', ['portifolio' => $portifolio]);

    }

    public function add(){

        /*
        * PERMISSÃO DO USUÁRIO
        *
        * Visualizar formulario para add portifolio
        *
        * verifica a permissão do usuário
        * se usuario autorizado segue o código, caso contrário retorna para página anterior
        */
        if(Gate::denies('add_portifolio'))
            return redirect()->back()->with('erro', 'Você não tem permissão para adicionar um novo registro, entre em contato com o administrador do site!');

        return view('painel.portifolio.add');

    }

    public function create(Request $request){

        /*
        * PERMISSÃO DO USUÁRIO
        *
        * Criar um novo portifolio
        *
        * verifica a permissão do usuário
        * se usuario autorizado segue o código, caso contrário retorna para página anterior
        */
        if(Gate::denies('create_portifolio'))
            return redirect()->back()->with('erro', 'Você não tem permissão para criar um novo registro, entre em contato com o administrador do site!');

        $this->validate($request, [
            'titulo' => 'required|max:255',
        ]);

        $portifolio = new portifolio();

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('imagem'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $portifolio->imagem = $this->moverImagem($image, $extensao);
        }

        $portifolio->titulo = $request->input('titulo');

        if(empty($request->input('status'))) {
            $portifolio->status = '0';
        }else{
            $portifolio->status = $request->input('status');
        }

        if($portifolio->save()){
            return redirect('/painel/portifolio')->with('sucesso', 'Portifolio cadastrado com sucesso!');
        }else{
            return redirect('/painel/portifolio')->with('erro', 'Erro ao cadastrar o portifolio, tente novamente mais tarde!');
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
        if(Gate::denies('edit_portifolio'))
            return redirect()->back()->with('erro', 'Você não tem permissão para editar este registro, entre em contato com o administrador do site!');

        $portifolio = $this->portifolio->find($id);

        return view('painel.portifolio.edit', ['portifolio' => $portifolio]);

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
        if(Gate::denies('update_portifolio'))
            return redirect()->back()->with('erro', 'Você não tem permissão para Atualizar este registro, entre em contato com o administrador do site!');

        $this->validate($request, [
            'titulo' => 'required|max:255',
        ]);

        $portifolio = $this->portifolio->find($id);

        //verifica se foi enviada alguma imagem com o formulário
        if($request->file('imagem')){

            //metodo que verifica se a imagem salva no banco exite no diretorio
            //caso exista remove a mesma do diretorio
            $this->removeImagemDir($portifolio->imagem);

            //armazena a nova imagem
            $image = $request->file('imagem');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $portifolio->imagem = $this->moverImagem($image, $extensao);
        }

        $portifolio->titulo = $request->input('titulo');

        if(empty($request->input('status'))) {
            $portifolio->status = '0';
        }else{
            $portifolio->status = $request->input('status');
        }

        if($portifolio->update()){
            return redirect('/painel/portifolio')->with('sucesso', 'Portifolio editado com sucesso!');
        }else{
            return redirect('/painel/portifolio')->with('erro', 'Erro ao editar o portifolio, tente novamente mais tarde!');
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
        if(Gate::denies('detail_portifolio'))
            return redirect()->back()->with('erro', 'Você não tem permissão para visualizar este registro, entre em contato com o administrador do site!');

        $portifolio = $this->portifolio->find($id);

        return view('painel.portifolio.detail', ['portifolio' => $portifolio]);

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
        if(Gate::denies('delete_portifolio'))
            return redirect()->back()->with('erro', 'Você não tem permissão para deletar este registro, entre em contato com o administrador do site!');

        $portifolio = $this->portifolio->find($id);

        if($portifolio->delete()){

            //metodo que verifica se a imagem salva no banco exite no diretorio
            //caso exista remove a mesma do diretorio
            $this->removeImagemDir($portifolio->imagem);

            return redirect('/painel/portifolio')->with('sucesso', 'Portifolio deletado com sucesso!');
        }else{
            return redirect('/painel/portifolio')->with('erro', 'Erro ao deletar o portifolio, tente novamente mais tarde!');
        }

    }

    /*
     * Metodo responsavel por verificar a extensao, redimencionar e mover a imagem para seu destino
     */
    public function moverImagem($image, $extensao){

        if(!in_array($extensao, $this->extensoes)) {
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos jpg, jpeg e png');
        } else {

            $filename = 'portifolio' . time() . '.' . $extensao;

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
