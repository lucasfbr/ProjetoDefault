<?php

namespace App\Http\Controllers\Painel;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Artigo;
use App\User;
use App\Categoria;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ArtigoController extends Controller
{
    private $artigo;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = 'img/artigos/';

    public function __construct(Artigo $artigo)
    {
        $this->artigo = $artigo;
        \Carbon\Carbon::setLocale('pt_BR');
    }

    public function index($tipo = 'lista'){

        /*
        * PERMISSÃO DO USUÁRIO
        *
        * Exibir artigos
        *
        * verifica a permissão do usuário
        * se usuario autorizado segue o código, caso contrário retorna para página anterior
        */
        if(Gate::denies('view_artigo'))
            return redirect()->back()->with('erro', 'Você não tem permissão para exibir esta página, entre em contato com o administrador do site!');


        $artigos = $this->artigo->with('user')->paginate(6);


        return view('painel.artigo.index', compact('artigos','tipo'));

    }


    public function lixeira($tipo = 'lixeira'){

        /*
       * PERMISSÃO DO USUÁRIO
       *
       * Exibir artigos
       *
       * verifica a permissão do usuário logado
       * se usuario é autorizado, segue o código, caso contrário retorna para página anterior
       */
        if(Gate::denies('view_artigo'))
            return redirect()->back()->with('erro', 'Você não tem permissão para exibir esta página, entre em contato com o administrador do site!');


        //busca o scope da lixeira que vem definido por default no laravel
        //o campo responsavel é o campo deleted_at
        $artigos = $this->artigo->onlyTrashed()->paginate(6);


        return view('painel.artigo.index', compact('artigos','tipo'));


    }


    public function detail($id){


        /*
        * PERMISSÃO DO USUÁRIO
        *
        * Exibir detalhes do artigo
        *
        * verifica a permissão do usuário
        * se usuario autorizado segue o código, caso contrário retorna para página anterior
        */
        if(Gate::denies('detail_artigo'))
            return redirect()->back()->with('erro', 'Você não tem permissão para exibir os detalhes deste artigo, entre em contato com o administrador do site!');

        $artigo = $this->artigo->find($id);

        return view('painel.artigo.detail', compact('artigo'));

    }

    public function add(){


        /*
       * PERMISSÃO DO USUÁRIO
       *
       * Exibir formulario para adicionar artigo
       *
       * verifica a permissão do usuário
       * se usuario autorizado segue o código, caso contrário retorna para página anterior
       */
        if(Gate::denies('add_artigo'))
            return redirect()->back()->with('erro', 'Você não tem permissão para adicionar um novo artigo, entre em contato com o administrador do site!');

        $categorias = Categoria::all();

        return view('painel.artigo.add', compact('categorias'));

    }

    public function create(Request $request){


        /*
       * PERMISSÃO DO USUÁRIO
       *
       * Criar novo artigo
       *
       * verifica a permissão do usuário
       * se usuario autorizado segue o código, caso contrário retorna para página anterior
       */
        if(Gate::denies('create_artigo'))
            return redirect()->back()->with('erro', 'Você não tem permissão para criar artigos, entre em contato com o administrador do site!');

        $this->validate($request, [

            'user_id' => 'required',
            'categoria_id' => 'required',
            'titulo' => 'required',
            'conteudo' => 'required|min:10',
            'published_at' => 'required'

        ]);

        $user = User::find(Auth::user()->id);

        $input = $request->all();

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('imagem'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $input['imagem'] = $this->moverImagem($image, $extensao);
        }

        $artigo = $user->artigo()->create($input);

        if($artigo){
            return redirect('/painel/artigo/')->with('sucesso', 'Artigo cadastrado com sucesso!');
        }else{
            return redirect('/painel/artigo/')->with('erro', 'Erro ao cadastrar o artigo, tente novamente mais tarde!');
        }


    }

    public function edit($id){

        /*
      * PERMISSÃO DO USUÁRIO
      *
      * Editar artigo
      *
      * verifica a permissão do usuário
      * se usuario autorizado segue o código, caso contrário retorna para página anterior
      */
        if(Gate::denies('edit_artigo'))
            return redirect()->back()->with('erro', 'Você não tem permissão para editar artigos, entre em contato com o administrador do site!');

        $categorias = Categoria::all();

        $artigo = $this->artigo->find($id);

        return view('painel.artigo.edit', compact('artigo', 'categorias'));

    }

    public function update(Request $request, $id){

        /*
     * PERMISSÃO DO USUÁRIO
     *
     * Update artigo
     *
     * verifica a permissão do usuário
     * se usuario autorizado segue o código, caso contrário retorna para página anterior
     */
        if(Gate::denies('update_artigo'))
            return redirect()->back()->with('erro', 'Você não tem permissão para atualizar artigos, entre em contato com o administrador do site!');


        $this->validate($request, [
            'categoria_id' => 'required',
            'titulo'   => 'required',
            'conteudo' => 'required|min:10',
            'published_at' => 'required'
        ]);

        $user = User::find(Auth::user()->id);

        $artigo = $user->artigo->find($id);

        $input = $request->all();

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('imagem'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $input['imagem'] = $this->moverImagem($image, $extensao);
        }

        $update = $artigo->update($input);

        //atualizando o artigo e redirecionando para a lista de artigos
        if($update){
            return redirect('/painel/artigo/')->with('sucesso', 'Artigo atualizado com sucesso!');
        }else{
            return redirect('/painel/artigo/')->with('erro', 'Erro ao atualizar o artigo, tente novamente mais tarde!');
        }
    }

    public function delete($id){

         /*
          * PERMISSÃO DO USUÁRIO
          *
          * Update artigo
          *
          * verifica a permissão do usuário
          * se usuario autorizado segue o código, caso contrário retorna para página anterior
          */
        if(Gate::denies('delete_artigo'))
            return redirect()->back()->with('erro', 'Você não tem permissão para deletar artigos, entre em contato com o administrador do site!');

        $artigo =  $this->artigo->find($id);

        if($artigo->delete()){

            return redirect('/painel/artigo/')->with('sucesso', 'Artigo deletado com sucesso!');
        }else{
            return redirect('/painel/artigo/')->with('erro', 'Erro ao deletar o artigo, tente novamente mais tarde!');
        }

    }

    public function restore($id){

        /*
      * PERMISSÃO DO USUÁRIO
      *
      * Update artigo
      *
      * verifica a permissão do usuário
      * se usuario autorizado segue o código, caso contrário retorna para página anterior
      */
        if(Gate::denies('restore_artigo'))
            return redirect()->back()->with('erro', 'Você não tem permissão para restaurar artigos, entre em contato com o administrador do site!');

        $trashed = $this->artigo->withTrashed()->find($id);

        $trashed->restore();

        return redirect('/painel/artigo/lixeira')->with('sucesso', 'Artigo restaurado com sucesso!');

    }

    public function limparLixeira(){

        /*
    * PERMISSÃO DO USUÁRIO
    *
    * Update artigo
    *
    * verifica a permissão do usuário
    * se usuario autorizado segue o código, caso contrário retorna para página anterior
    */
        if(Gate::denies('restore_artigo'))
            return redirect()->back()->with('erro', 'Você não tem permissão para restaurar artigos, entre em contato com o administrador do site!');


        $artigos = $this->artigo->onlyTrashed()->get();

        $array = array();

        foreach ($artigos as $art){
            $array[] = $art->id;
        }

        if($this->artigo->whereIn('id', $array)->forceDelete()){
            return redirect('/painel/artigo/lixeira')->with('sucesso', 'lixeira limpa com sucesso!');
        }else{
            return redirect('/painel/artigo/lixeira')->with('erro', 'Erro ao limpar a lixeira, tente novamente mais tarde');
        }

    }

    /*
     * Metodo responsavel por verificar a extensao, redimencionar e mover a imagem para seu destino
     */
    public function moverImagem($image, $extensao){

        if(!in_array($extensao, $this->extensoes)) {
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos: jpg, jpeg e png');
        } else {

            $filename = 'artigos' . time() . '.' . $extensao;

            $path = public_path($this->caminhoImg . $filename);

            Image::make($image->getRealPath())->resize(920,490)->save($path);

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
