<?php

namespace App\Http\Controllers\Painel;

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


    public function index(){
        
        $artigos = Artigo::all();

        return view('painel.artigo.index', compact('artigos'));

    }


    public function detail($id){

        $artigo = $this->artigo->find($id);

        $user = $artigo->user;

        return view('painel.artigo.detail', compact('artigo','user'));

    }

    public function add(){

        return view('painel.artigo.add');

    }

    public function create(Request $request){

        $this->validate($request, [

            'user_id' => 'required',
            'titulo' => 'required',
            'conteudo' => 'required|min:10'

        ]);

        $artigo = new artigo();

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('imagem'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $artigo->imagem = $this->moverImagem($image, $extensao);
        }

        $artigo->user_id  = $request->user_id;
        $artigo->titulo   = $request->titulo;
        $artigo->conteudo = $request->conteudo;

        if($artigo->save()){
            return redirect('/painel/artigo')->with('sucesso', 'artigo cadastrado com sucesso!');
        }else{
            return redirect('/painel/artigo')->with('erro', 'Erro ao cadastrar o artigo, tente novamente mais tarde!');
        }

    }

    public function edit($id){

        $artigo = $this->artigo->find($id);

        return view('painel.artigo.edit', compact('artigo'));

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'titulo'   => 'required',
            'conteudo' => 'required|min:10'

        ]);

        $artigo =  $this->artigo->find($id);

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('imagem'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('imagem');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $artigo->imagem = $this->moverImagem($image, $extensao);
        }

        $artigo->titulo = $request->titulo;
        $artigo->conteudo = $request->conteudo;

        //atualizando o artigo e redirecionando para a lista de artigos
        if($artigo->update()){
            return redirect('/painel/artigo')->with('sucesso', 'artigo atualizado com sucesso!');
        }else{
            return redirect('/painel/artigo')->with('erro', 'Erro ao atualizar o artigo, tente novamente mais tarde!');
        }
    }

    public function delete($id){

        $artigo = $this->artigo->find($id);

        if($artigo->delete()){

            //metodo que verifica se a imagem salva no banco exite no diretorio
            //caso exista remove a mesma do diretorio
            $this->removeImagemDir($artigo->imagem);

            return redirect('/painel/artigo')->with('sucesso', 'artigo deletado com sucesso!');
        }else{
            return redirect('/painel/artigo')->with('erro', 'Erro ao deletar o artigo, tente novamente mais tarde!');
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
