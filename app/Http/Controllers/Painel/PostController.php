<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;

use Illuminate\Http\File;


class PostController extends Controller
{
    private $post;
    private $extensoes = ['jpg', 'png'];

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


        if($request->file('img_p') || $request->file('img_g')){

            $imgP = $request->file('img_p');
            $imgG = $request->file('img_g');

            if($imgP){
                $extensaoP = $imgP->getClientOriginalExtension();

                if(!in_array($extensaoP, $this->extensoes)){

                    return back()->with('erro', 'Imagem do resumo fora dos padrões, portanto devem ser no formato .jpg ou .png');

                }
            }

            if($imgG){
                $extensaoG = $imgG->getClientOriginalExtension();

                if(!in_array($extensaoG, $this->extensoes)){

                    return back()->with('erro', 'Imagem do post fora dos padrões, portanto devem ser no formato .jpg ou .png');

                }
            }

        }

        $post = new Post();

        $post->titulo = $request->input('titulo');
        $post->conteudo = $request->input('conteudo');
        $post->user_id = $request->input('user_id');
        $post->img_p = '';
        $post->img_g = '';

        if($post->save()){

            if($imgP || $imgG){

                $img_p_name = 'post_id_'.$post->id.'_'.$imgP->getClientOriginalName();
                $img_g_name = 'post_id_'.$post->id.'_'.$imgG->getClientOriginalName();

                $path = base_path() . '/public/assets/all/imagens_post/';

                $request->file('img_p')->move($path, $img_p_name);

                $request->file('img_g')->move($path, $img_g_name);

                $post->img_p = $path.$img_p_name;
                $post->img_g = $path.$img_g_name;

                if($post->save()){
                    return redirect('/painel/post')->with('sucesso', 'Post cadastrado com sucesso!');
                }else{
                    return redirect('/painel/post')->with('erro', 'Post cadastrado com sucesso, mas ocorreu algum erro a salvar as fotos, tente novamente mais tarde');
                }

            }else{

                return redirect('/painel/post')->with('sucesso', 'Post cadastrado com sucesso!');

            }

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
