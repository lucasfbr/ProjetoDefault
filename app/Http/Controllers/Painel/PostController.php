<?php

namespace App\Http\Controllers\Painel;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\User;
use App\Categoria;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Symfony\Component\Debug\Tests\Fixtures\ToStringThrower;


class PostController extends Controller
{
    private $post;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = 'img/posts/';

    public function __construct(Post $post)
    {
        $this->post = $post;
        \Carbon\Carbon::setLocale('pt_BR');
    }

    public function index($tipo = 'published'){

        $user = User::find(Auth::user()->id);

        if($user->tipo != 'Administrador') {

            if ($tipo == 'publicado') {
                //foi criado no model um scope que representará uma query que foi nomeada de "published"
                $posts = $user->post()->latest('published_at')->published()->paginate(6);
            }elseif($tipo == 'agendado') {
                //foi criado no model um scope que representará uma query que foi nomeada de "unpublished"
                $posts = $user->post()->latest('published_at')->unpublished()->paginate(6);
            }else {
                //busca o scope da lixeira que vem definido por default no laravel
                //o campo responsavel é o campo deleted_at
                $posts = $user->post()->onlyTrashed->paginate(6);
            }

        }else{

            $posts = new Post;

            if ($tipo == 'publicado') {
                //foi criado no model um scope que representará uma query que foi nomeada de "published"
                $posts = $posts->latest('published_at')->published()->with('user')->paginate(6);
            }elseif($tipo == 'agendado'){
                //foi criado no model um scope que representará uma query que foi nomeada de "unpublished"
                $posts = $posts->latest('published_at')->unpublished()->with('user')->paginate(6);
            }else{
                //busca o scope da lixeira que vem definido por default no laravel
                //o campo responsavel é o campo deleted_at
                $posts = $posts->onlyTrashed()->paginate(6);
            }
        }

        return view('painel.post.index', compact('posts','tipo'));

    }

    public function detail($id,$tipo){

        $user = User::find(Auth::user()->id);

        $postUser = $user->post->find($id);

        if((!$postUser) AND ($user->tipo != 'Administrador')){
            return redirect('/painel/post/'.$tipo);
        }else{
            $post =  Post::find($id);
        }

        return view('painel.post.detail', compact('post','tipo'));

    }

    public function add($tipo){

        $categorias = Categoria::all();

        return view('painel.post.add', compact('tipo','categorias'));

    }

    public function create(Request $request){

        $this->validate($request, [

            'user_id' => 'required',
            'categoria_id' => 'required',
            'titulo' => 'required',
            'conteudo' => 'required|min:10',
            'published_at' => 'required'

        ]);

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

        $post = $this->post->create($input);

        if($post){
            return redirect('/painel/post/'.$tipo)->with('sucesso', 'Post cadastrado com sucesso!');
        }else{
            return redirect('/painel/post/'.$tipo)->with('erro', 'Erro ao cadastrar o post, tente novamente mais tarde!');
        }


    }

    public function edit($id,$tipo){

        $user = User::find(Auth::user()->id);

        $post =  $user->post->find($id);

        if((!$post) AND ($user->tipo != 'Administrador')){
            return redirect('/painel/post/'.$tipo);
        }else{
            $post =  $this->post->find($id);
        }

        $categorias = Categoria::all();

        return view('painel.post.edit', compact('post','tipo', 'categorias'));

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

        $post =  $user->post->find($id);

        if((!$post) AND ($user->tipo != 'Administrador')){
            return redirect('/painel/post/'.$tipo);
        }else{
            $post =  $this->post->find($id);
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

        $update = $post->update($input);

        //atualizando o post e redirecionando para a lista de posts
        if($update){
            return redirect('/painel/post/'.$tipo)->with('sucesso', 'Post atualizado com sucesso!');
        }else{
            return redirect('/painel/post/'.$tipo)->with('erro', 'Erro ao atualizar o post, tente novamente mais tarde!');
        }
    }

    public function delete($id,$tipo){

        $user = User::find(Auth::user()->id);

        $post =  $user->post->find($id);

        if((!$post) AND ($user->tipo != 'Administrador')){
            return redirect('/painel/post/'.$tipo);
        }else{
            $post =  $this->post->find($id);
        }

        if($post->delete()){

            //metodo que verifica se a imagem salva no banco exite no diretorio
            //caso exista remove a mesma do diretorio
            //$this->removeImagemDir($post->imagem);

            return redirect('/painel/post/'.$tipo)->with('sucesso', 'Post deletado com sucesso!');
        }else{
            return redirect('/painel/post/'.$tipo)->with('erro', 'Erro ao deletar o post, tente novamente mais tarde!');
        }

    }

    public function restore($id){

        $user = User::find(Auth::user()->id);

        $post = $user->post->find($id);

        if((!$post) AND ($user->tipo != 'Administrador')){
            return redirect('/painel/post/trashed');
        }

        $trashed = $this->post->withTrashed()->find($id);

        $trashed->restore();

        return redirect('/painel/post/published');

    }

    /*
     * Metodo responsavel por verificar a extensao, redimencionar e mover a imagem para seu destino
     */
    public function moverImagem($image, $extensao){

        if(!in_array($extensao, $this->extensoes)) {
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos: jpg, jpeg e png');
        } else {

            $filename = 'posts' . time() . '.' . $extensao;

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
