<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    private $post;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = 'img/posts/';

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index($tipo = 'published'){

        $user = User::find(Auth::user()->id);

        if($tipo == 'published') {
            //foi criado no model um scope que representará uma query que foi nomeada de "published"
            $posts = $user->post()->latest('published_at')->published()->get();
        }else{
            //foi criado no model um scope que representará uma query que foi nomeada de "unpublished"
            $posts = $user->post()->latest('published_at')->unpublished()->get();
        }

        return view('painel.post.index', compact('posts','tipo'));

    }

    public function detail($id,$tipo){

        $user = User::find(Auth::user()->id);

        $post = $user->post->find($id);

        if(!$post){
            return redirect('/painel/post/'.$tipo);
        }

        return view('painel.post.detail', compact('post','user','tipo'));

    }

    public function add($tipo){

        return view('painel.post.add', compact('tipo'));

    }

    public function create(Request $request){

        $this->validate($request, [

            'user_id' => 'required',
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

        if(!$post){
            return redirect('/painel/post/'.$tipo);
        }

        return view('painel.post.edit', compact('post','tipo'));

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'titulo'   => 'required',
            'conteudo' => 'required|min:10',
            'published_at' => 'required'
        ]);

        $tipo = $request->tipo;

        $user = User::find(Auth::user()->id);

        $post =  $user->post->find($id);

        if(!$post){
            return redirect('/painel/post/'.$tipo);
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

        if(!$post){
            return redirect('/painel/post/'.$tipo);
        }

        if($post->delete()){

            //metodo que verifica se a imagem salva no banco exite no diretorio
            //caso exista remove a mesma do diretorio
            $this->removeImagemDir($post->imagem);

            return redirect('/painel/post/'.$tipo)->with('sucesso', 'Post deletado com sucesso!');
        }else{
            return redirect('/painel/post/'.$tipo)->with('erro', 'Erro ao deletar o post, tente novamente mais tarde!');
        }

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

            Image::make($image->getRealPath())->resize(640,427)->save($path);

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
