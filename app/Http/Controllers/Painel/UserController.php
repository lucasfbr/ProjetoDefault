<?php

namespace App\Http\Controllers\Painel;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{

    private $user;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = 'img/usuarios/';

    public function __construct(User $user)
    {
        //$this->middleware('auth');

        $this->user = $user;
    }

    public function index(){

        $users = User::with('perfis')->get();

        return view('painel.user.index', ['users' => $users]);

    }

    //metodo que responderá a requisição ajax vinda do vuejs
    //retorna um objeto json
    public function listUser(){

        $data = User::with('perfis')->orderBy('name', 'asc')->get();

        return response()->json($data);

    }

    public function detail($id){

        $user = $this->user->find($id);

        //$user->habilidades = $this->formataHabilidades($user->habilidades);

        return view('painel.user.detail', ['user' => $user]);

    }

    public function add(){

        return view('painel.user.add');

    }

    public function create(Request $request){

        $this->validate($request, [

            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',

        ]);

        $user = new User();

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
        $user->password = bcrypt($request->input('password'));
        $user->tipo = $request->input('tipo');
        $user->usuarioPrincipal = $request->input('usuarioPrincipal');

        if($user->save()){

            $userPerfil = $this->user->find($user->id);

            $userPerfil->perfis()->create($request->all());

            return redirect('/painel/user')->with('sucesso', 'Usuário cadastrado com sucesso!');
        }else{
            return redirect('/painel/user')->with('erro', 'Ocorreu algum erro ao cadastrar um novo usuário, tente novamente mais tarde!');
        }

    }

    public function edit(Request $request, $id){

        $user = $this->user->find($id);

        return view('painel.user.edit', ['user' => $user]);

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = $this->user->find($id);

        //verifica se foi alterada a senha
        if(!empty($request->input('password'))){
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
        $user->password = bcrypt($request->input('password'));
        $user->tipo = $request->input('tipo');
        $user->usuarioPrincipal = $request->input('usuarioPrincipal');

        if($user->update()){
            return redirect('/painel/user')->with('sucesso', 'Dados do usuário editados com sucesso!');
        }else{
            return redirect('/painel/user')->with('erro', 'Ocorreu algum erro ao editar os dados do usuário, tente novamente mais tarde!');
        }

    }

    public function delete($id){

        if(auth()->user()->id != $id) {

            $user = $this->user->find($id);

            if($user->delete($id)) {
                //metodo que verifica se a imagem salva no banco exite no diretorio
                //caso exista remove a mesma do diretorio
                $this->removeImagemDir($user->foto);

                return redirect('/painel/user')->with('sucesso', 'Usuário deletado com sucesso!');
            }else{

                return redirect('/painel/user')->with('erro', 'Ocorreu algum erro ao deletar os dados do usuário, tente novamente mais tarde!!');

            }

        }else{
            return redirect('/painel/user')->with('erro', 'Você esta logado com este usuário, portanto não pode excluir o mesmo!!!');
        }
    }

    public function ativar($id){

        $user = $this->user->find($id);

        $user->status = '1';
        if($user->save()){
            return redirect('/painel/user')->with('sucesso', 'Usuario ativado com sucesso!');
        }else{
            return redirect('/painel/user')->with('erro', 'Erro ao ativar o usuário, tente novamente mais tarde!');
        }
    }

    public function desativar($id){

        $user = $this->user->find($id);

        $user->status = '0';
        if($user->save()){
            return redirect('/painel/user')->with('sucesso', 'Usuario desativado com sucesso!');
        }else{
            return redirect('/painel/user')->with('erro', 'Erro ao desativar o usuário, tente novamente mais tarde!');
        }

    }

    public function formataHabilidades($value){

        $habilidades = explode(",", $value);

        //var_dump($habilidades);exit;

        return $habilidades;

    }

    /*
    * Metodo responsavel por verificar a extensao, redimencionar e mover a imagem para seu destino
    */
    public function moverImagem($image, $extensao){

        if(!in_array($extensao, $this->extensoes)) {
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos jpg, jpeg e png');
        } else {

            $filename = 'portifolio' . time() . '.' . $extensao;

            $path = public_path($this->caminhoImg . $filename);

            Image::make($image->getRealPath())->resize(64,64)->save($path);

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
