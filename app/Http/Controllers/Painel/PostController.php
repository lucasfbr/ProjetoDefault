<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{
    private $post;
    private $extensoes = ['jpg', 'png'];
    private $caminhoImg = '/assets/all/imagens_post/';

    public function __construct(Post $post)
    {
        $this->middleware('auth');

        $this->post = $post;
    }

    public function index(){

        $posts = $this->post->all();

        return view('painel.post.index', ['posts' => $posts]);

    }

    public function detail($id){

        $post = $this->post->find($id);

        return view('painel.post.detail', ['post' => $post]);

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

        $post->titulo = $request->input('titulo');
        $post->conteudo = $request->input('conteudo');
        $post->user_id = $request->input('user_id');
        $post->img_p = '';
        $post->img_g = '';

        if($post->save()){

            if($request->file('img_p')){

                $image = $request->file('img_p');

                $filename  = 'P_' . time() . '.' . $image->getClientOriginalExtension();

                $path = public_path($this->caminhoImg . $filename);

                Image::make($image->getRealPath())->resize(200, 200)->save($path);

                $post->img_p = $this->caminhoImg . $filename;

                $post->save();
            }

            if($request->file('img_g')){

                $image = $request->file('img_g');

                $filename  = 'G_' . time() . '.' . $image->getClientOriginalExtension();

                $path = public_path($this->caminhoImg . $filename);

                Image::make($image->getRealPath())->resize(400, 300)->save($path);

                $post->img_g = $this->caminhoImg . $filename;

                $post->save();
            }

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
