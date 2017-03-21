<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
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

    public function index(){

        $posts = $this->post->all();

        return view('painel.post.index', compact('posts'));

    }

    public function detail($id){

        $post = $this->post->find($id);

        $user = $post->user;

        return view('painel.post.detail', compact('post','user'));

    }

    public function add(){

        return view('painel.post.add');

    }

    public function create(Request $request){

        $this->validate($request, [

            'user_id' => 'required',
            'titulo' => 'required',
            'conteudo' => 'required|min:10'

        ]);

        $post = new Post();

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('imagem'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $post->imagem = $this->moverImagem($image, $extensao);
        }

        $post->user_id  = $request->user_id;
        $post->titulo   = $request->titulo;
        $post->conteudo = $request->conteudo;

        if($post->save()){
            return redirect('/painel/post')->with('sucesso', 'Post cadastrado com sucesso!');
        }else{
            return redirect('/painel/post')->with('erro', 'Erro ao cadastrar o post, tente novamente mais tarde!');
        }


    }

    public function edit($id){

        $post = $this->post->find($id);

        return view('painel.post.edit', ['post' => $post]);

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'titulo'   => 'required',
            'conteudo' => 'required|min:10'

        ]);

        $post =  $this->post->find($id);

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('imagem'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $post->imagem = $this->moverImagem($image, $extensao);
        }

        $post->titulo = $request->titulo;
        $post->conteudo = $request->conteudo;

        //atualizando o post e redirecionando para a lista de posts
        if($post->update()){
            return redirect('/painel/post')->with('sucesso', 'Post atualizado com sucesso!');
        }else{
            return redirect('/painel/post')->with('erro', 'Erro ao atualizar o post, tente novamente mais tarde!');
        }
    }

    public function delete($id){

        $post = $this->post->find($id);

        if($post->delete()){

            //metodo que verifica se a imagem salva no banco exite no diretorio
            //caso exista remove a mesma do diretorio
            $this->removeImagemDir($post->imagem);

            return redirect('/painel/post')->with('sucesso', 'Post deletado com sucesso!');
        }else{
            return redirect('/painel/post')->with('erro', 'Erro ao deletar o post, tente novamente mais tarde!');
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
