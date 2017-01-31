<?php

namespace App\Http\Controllers\Painel;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->middleware('auth');

        $this->post = $post;
    }

    public function index(){

        $posts = $this->post->all();

        return view('painel.post.index', ['posts' => $posts]);

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

        $post = $request->only('user_id','titulo','conteudo');

        if(Post::create($post)){
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

        $dados = $request->only('titulo', 'conteudo');

        //atualizando o post e redirecionando para a lista de posts
        if($post->update($dados)){
            return redirect('/painel/post')->with('sucesso', 'Post atualizado com sucesso!');
        }else{
            return redirect('/painel/post')->with('erro', 'Erro ao atualizar o post, tente novamente mais tarde!');
        }
    }

    public function delete($id){

        $post = Post::find($id);

        if($post->delete()){
            return redirect('/painel/post')->with('sucesso', 'Post deletado com sucesso!');
        }else{
            return redirect('/painel/post')->with('erro', 'Erro ao deletar o post, tente novamente mais tarde!');
        }

    }


}
