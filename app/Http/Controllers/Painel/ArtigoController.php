<?php

namespace App\Http\Controllers\Painel;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Artigo;

class ArtigoController extends Controller
{

    private $artigo;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = 'img/artigos/';


    public function __construct(Artigo $artigo)
    {
        $this->artigo = $artigo;
    }

    public function index($tipo){


        if($tipo == 'published') {
            //foi criado no model um scope que representará uma query que foi nomeada de "published"
            $artigos = Artigo::latest('published_at')->published()->get();
        }else{
            //foi criado no model um scope que representará uma query que foi nomeada de "unpublished"
            $artigos = Artigo::latest('published_at')->unpublished()->get();
        }

        return view('painel.artigo.index', compact('artigos', 'tipo'));

    }

    public function detail($id,$tipo){

        $artigo = $this->artigo->find($id);

        $user = $artigo->user;

        return view('painel.artigo.detail', compact('artigo','user','tipo'));

    }

    public function add($tipo){

        return view('painel.artigo.add', compact('tipo'));

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

       $artigo = $this->artigo->create($input);

        if($artigo){
            return redirect('/painel/artigo/'.$tipo)->with('sucesso', 'artigo cadastrado com sucesso!');
        }else{
            return redirect('/painel/artigo/'.$tipo)->with('erro', 'Erro ao cadastrar o artigo, tente novamente mais tarde!');
        }

    }

    public function edit($id,$tipo){

        $artigo = $this->artigo->find($id);

        return view('painel.artigo.edit', compact('artigo','tipo'));

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'titulo'   => 'required',
            'conteudo' => 'required|min:10',
            'published_at' => 'required'


        ]);

        $artigo =  $this->artigo->find($id);

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

        $update = $artigo->update($input);

        //atualizando o artigo e redirecionando para a lista de artigos
        if($update){
            return redirect('/painel/artigo/'.$tipo)->with('sucesso', 'artigo atualizado com sucesso!');
        }else{
            return redirect('/painel/artigo/'.$tipo)->with('erro', 'Erro ao atualizar o artigo, tente novamente mais tarde!');
        }
    }

    public function delete($id,$tipo){

        $artigo = $this->artigo->find($id);

        if($artigo->delete()){

            //metodo que verifica se a imagem salva no banco exite no diretorio
            //caso exista remove a mesma do diretorio
            $this->removeImagemDir($artigo->imagem);

            return redirect('/painel/artigo/'.$tipo)->with('sucesso', 'artigo deletado com sucesso!');
        }else{
            return redirect('/painel/artigo/'.$tipo)->with('erro', 'Erro ao deletar o artigo, tente novamente mais tarde!');
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
