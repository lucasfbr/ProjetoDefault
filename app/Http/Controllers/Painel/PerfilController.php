<?php

namespace App\Http\Controllers\Painel;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class PerfilController extends Controller
{
    private $user;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = 'img/usuarios/';

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(){

        $user = $this->user->find(Auth::user()->id);

        $perfil = $user->perfis;

        $formacao = $user->formacao;

        return view('painel.perfil.index', compact('user','perfil','formacao'));

    }

    public function update(Request $request, $id){

        $user = $this->user->find($id);

        $dados = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'cep' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'logradouro' => 'required',
            'numero' => 'required',
            'numero' => 'required',
            'celular' => 'required',
            'sexo' => 'required',
            'empresa' => 'required',
            'profissao' => 'required',
        ];

        if($request->input('password')){
            $dados = array_add($dados, 'password', 'required|min:6|confirmed');
        }

        //usuario consultor
        if($user->tipo == 1){
            $dados = array_add($dados, 'resumo', 'required');
            $dados = array_add($dados, 'descricao', 'required');
            $dados = array_add($dados, 'habilidades', 'required');
        }

        $this->validate($request, $dados);

        //verifica se foi alterada a senha
        if($request->input('password')){
            $user->password = bcrypt($request->input('password'));
        }

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('foto'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('foto');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $user->foto = $this->moverImagem($image, $extensao);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->perfil = '1';

        if($user->update()){

            $perfil = $user->perfis;

            if($perfil) {

                $perfil->resumo = $request->input('resumo');
                $perfil->descricao = $request->input('descricao');
                $perfil->fone = $request->input('fone');
                $perfil->celular = $request->input('celular');
                $perfil->cep = $request->input('cep');
                $perfil->estado = $request->input('estado');
                $perfil->cidade = $request->input('cidade');
                $perfil->bairro = $request->input('bairro');
                $perfil->logradouro = $request->input('logradouro');
                $perfil->numero = $request->input('numero') ? $request->input('numero') : '0';
                $perfil->complemento = $request->input('complemento');
                $perfil->profissao = $request->input('profissao');
                $perfil->empresa = $request->input('empresa');
                $perfil->sexo = $request->input('sexo');
                $perfil->habilidades = $request->input('habilidades');
                $perfil->notas = $request->input('notas');

                if(!$perfil->update()){
                    return redirect('/painel/perfil')->with('erro', 'Ocorreu algum erro ao editar o perfil do usuário, tente novamente mais tarde!')->with('settings', 'active');;
                }

            }else{

                $user->perfis()->create([
                    'resumo' => $request->input('resumo'),
                    'descricao' => $request->input('descricao'),
                    'fone' => $request->input('fone'),
                    'celular' => $request->input('celular'),
                    'cep' => $request->input('cep'),
                    'estado' => $request->input('estado'),
                    'cidade' => $request->input('cidade'),
                    'bairro' => $request->input('bairro'),
                    'logradouro' => $request->input('logradouro'),
                    'numero' => $request->input('numero') ? $request->input('numero') : '0',
                    'complemento' => $request->input('complemento'),
                    'profissao' => $request->input('profissao'),
                    'empresa' => $request->input('empresa'),
                    'sexo' => $request->input('sexo'),
                    'habilidades' => $request->input('habilidades'),
                    'notas' => $request->input('notas')
                ]);
            }

            return redirect('/painel/perfil/')->with('sucesso', 'Dados do perfil editados com sucesso!')->with('settings', 'active');
        }else{
            return redirect('/painel/perfil/')->with('erro', 'Ocorreu algum erro ao editar os dados do perfil, tente novamente mais tarde!')->with('settings', 'active');
        }




    }

    /*
  * Metodo responsavel por verificar a extensao, redimencionar e mover a imagem para seu destino
  */
    public function moverImagem($image, $extensao){

        if(!in_array($extensao, $this->extensoes)) {
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos jpg, jpeg e png');
        } else {

            $filename = 'users' . time() . '.' . $extensao;

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
