<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\User;
use App\Formacao;

class FormacaoController extends Controller
{
    private $formacao;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = 'img/formacoes/';

    public function __construct(Formacao $formacao)
    {
        $this->formacao = $formacao;
    }

    public function index($id){

        $user = User::find($id);

        $formacoes = $user->formacao;

        return view('painel.formacao.index', ['formacoes' => $formacoes, 'usuarioId' => $id]);

    }

    public function add($id){

        return view('painel.formacao.add', ['user_id' => $id]);

    }

    public function create(Request $request){

        $this->validate($request, [
            'titulo' => 'required|max:255',
            'conteudo' => 'required',
        ]);

        $formacao = Formacao::create($request->all());

        if($formacao){
            return redirect('/painel/formacao/'. $request->input('user_id'))->with('sucesso', 'Formação cadastrado com sucesso!');
        }else{
            return redirect('/painel/formacao/'. $request->input('user_id'))->with('erro', 'Ocorreu algum erro ao cadastrar uma nova formação, tente novamente mais tarde!');
        }

    }

    public function edit(Request $request, $id){

        $formacao = $this->formacao->find($id);

        return view('painel.formacao.edit', ['formacao' => $formacao]);

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'titulo' => 'required|max:255',
            'conteudo' => 'required',
        ]);

        $formacao = $this->formacao->find($id);

        $update = $formacao->update($request->all());

        if($update){
            return redirect('/painel/formacao/'. $request->input('user_id'))->with('sucesso', 'Formação editada com sucesso!');
        }else{
            return redirect('/painel/formacao/'. $request->input('user_id'))->with('erro', 'Ocorreu algum erro ao editar uma formação, tente novamente mais tarde!');
        }

    }

    public function detail($id){

        $formacao = $this->formacao->find($id);

        $perfil = $formacao->perfis;

        return view('painel.Formacao.detail', ['Formacao' => $formacao, 'perfil' => $perfil]);

    }

    public function delete($id){

        $formacao = $this->formacao->find($id);

        if($formacao->delete()) {
            return redirect('/painel/formacao/'. $formacao->user_id)->with('sucesso', 'Formação deletado com sucesso!');
        }else {
            return redirect('/painel/formacao/'. $formacao->user_id)->with('erro', 'Ocorreu algum erro ao deletar os dados da formação, tente novamente mais tarde!!');
        }


    }
    
    /*
    * Metodo responsavel por verificar a extensao, redimencionar e mover a imagem para seu destino
    */
    public function moverImagem($image, $extensao){

        if(!in_array($extensao, $this->extensoes)) {
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos jpg, jpeg e png');
        } else {

            $filename = 'Formacaos' . time() . '.' . $extensao;

            $path = public_path($this->caminhoImg . $filename);

            Image::make($image->getRealPath())->resize(200,200)->save($path);

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
