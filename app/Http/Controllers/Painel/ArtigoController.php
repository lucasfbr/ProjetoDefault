<?php

namespace App\Http\Controllers\Painel;

use Carbon\Carbon;
use Gate;
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

    public function index($tipo = 'published'){

        /*
        $user = User::find(Auth::user()->id);

        if($user->tipo != 'Administrador') {

            if ($tipo == 'publicado') {

                //foi criado no model um scope que representará uma query que foi nomeada de "published"
                $artigos = $user->artigo()->latest('published_at')->published()->paginate(6);
            }elseif($tipo == 'agendado') {
                //foi criado no model um scope que representará uma query que foi nomeada de "unpublished"
                $artigos = $user->artigo()->latest('published_at')->unpublished()->paginate(6);
            }else {
                //busca o scope da lixeira que vem definido por default no laravel
                //o campo responsavel é o campo deleted_at
                $artigos = $user->artigo()->onlyTrashed->paginate(6);
            }

        }else{

            $artigos = new artigo;

            if ($tipo == 'publicado') {
                //foi criado no model um scope que representará uma query que foi nomeada de "published"
                $artigos = $artigos->latest('published_at')->published()->with('user')->paginate(6);
            }elseif($tipo == 'agendado'){
                //foi criado no model um scope que representará uma query que foi nomeada de "unpublished"
                $artigos = $artigos->latest('published_at')->unpublished()->with('user')->paginate(6);
            }else{
                //busca o scope da lixeira que vem definido por default no laravel
                //o campo responsavel é o campo deleted_at
                $artigos = $artigos->onlyTrashed()->paginate(6);
            }
        }
        */

        //$user = User::find(Auth::user()->id);

        //$artigos = $user->artigo()->latest('published_at')->published()->paginate(6);


        if(Gate::denies('view_artigo')) {
            return redirect()->back();
        }

        $artigos = $this->artigo->latest('published_at')->published()->with('user')->paginate(6);

        return view('painel.artigo.index', compact('artigos','tipo'));

    }

    public function detail($id,$tipo){

        $user = User::find(Auth::user()->id);

        $artigoUser = $user->artigo->find($id);

        if((!$artigoUser) AND ($user->tipo != 'Administrador')){
            return redirect('/painel/artigo/'.$tipo);
        }else{
            $artigo =  artigo::find($id);
        }

        return view('painel.artigo.detail', compact('artigo','tipo'));

    }

    public function add($tipo){

        $categorias = Categoria::all();

        return view('painel.artigo.add', compact('tipo','categorias'));

    }

    public function create(Request $request){

        $this->validate($request, [

            'user_id' => 'required',
            'categoria_id' => 'required',
            'titulo' => 'required',
            'conteudo' => 'required|min:10',
            'published_at' => 'required'

        ]);

        $user = User::find(Auth::user()->id);

        $input = $request->all();

        $tipo = $request->tipo;

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
            return redirect('/painel/artigo/'.$tipo)->with('sucesso', 'artigo cadastrado com sucesso!');
        }else{
            return redirect('/painel/artigo/'.$tipo)->with('erro', 'Erro ao cadastrar o artigo, tente novamente mais tarde!');
        }


    }

    public function edit($id,$tipo){

        /*$user = User::find(Auth::user()->id);

        $artigo =  $user->artigo->find($id);

        if((!$artigo) AND ($user->tipo != 'Administrador')){
            return redirect('/painel/artigo/'.$tipo);
        }else{
            $artigo =  $this->artigo->find($id);
        }*/

        $categorias = Categoria::all();

        $artigo = $this->artigo->find($id);

        //modo com mensagem padrao
        //$this->authorize('artigo-update', $artigo);
        //modo com mensagem personalizada
        //if(Gate::denies('update_artigo', $artigo))
        //    abort(403, 'Acesso não autorizado');

        return view('painel.artigo.edit', compact('artigo','tipo', 'categorias'));

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'categoria_id' => 'required',
            'titulo'   => 'required',
            'conteudo' => 'required|min:10',
            'published_at' => 'required'
        ]);

        $tipo = $request->tipo;

        $user = User::find(Auth::user()->id);

        $artigo =  $user->artigo->find($id);

        if((!$artigo) AND ($user->tipo != 'Administrador')){
            return redirect('/painel/artigo/'.$tipo);
        }else{
            $artigo =  $this->artigo->find($id);
        }

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
            return redirect('/painel/artigo/'.$tipo)->with('sucesso', 'artigo atualizado com sucesso!');
        }else{
            return redirect('/painel/artigo/'.$tipo)->with('erro', 'Erro ao atualizar o artigo, tente novamente mais tarde!');
        }
    }

    public function delete($id,$tipo){

        $user = User::find(Auth::user()->id);

        $artigo =  $user->artigo->find($id);

        if((!$artigo) AND ($user->tipo != 'Administrador')){
            return redirect('/painel/artigo/'.$tipo);
        }else{
            $artigo =  $this->artigo->find($id);
        }

        if($artigo->delete()){

            //metodo que verifica se a imagem salva no banco exite no diretorio
            //caso exista remove a mesma do diretorio
            //$this->removeImagemDir($artigo->imagem);

            return redirect('/painel/artigo/'.$tipo)->with('sucesso', 'artigo deletado com sucesso!');
        }else{
            return redirect('/painel/artigo/'.$tipo)->with('erro', 'Erro ao deletar o artigo, tente novamente mais tarde!');
        }

    }

    public function restore($id){

        $user = User::find(Auth::user()->id);

        $artigo = $user->artigo->find($id);

        if((!$artigo) AND ($user->tipo != 'Administrador')){
            return redirect('/painel/artigo/trashed');
        }

        $trashed = $this->artigo->withTrashed()->find($id);

        $trashed->restore();

        return redirect('/painel/artigo/published');

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
