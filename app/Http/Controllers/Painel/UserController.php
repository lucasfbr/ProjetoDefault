<?php

namespace App\Http\Controllers\Painel;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    private $user;
    private $extensoes = ['jpg','jpeg', 'png'];

    public function __construct(User $user)
    {
        $this->middleware('auth');

        $this->user = $user;
    }

    public function index(){

        //$nome = auth()->user()->name;

        $users = $this->user->all();

        return view('painel.user.index', ['users' => $users]);

    }

    public function detail($id){

        $user = $this->user->find($id);

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

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        if($request->file('foto')){

            $foto = $request->file('foto');
            $fotoTratada = $this->validaImagem($foto, $user);

            $user->foto = $fotoTratada;
        }

        if($user->save()){
            return redirect('/painel/user')->with('sucesso', 'Usuário cadstrado com sucesso!');
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

        $dados = $request->only('name', 'email', 'password');

        $user->update($dados);

        if($request->file('foto')){

            $foto = $request->file('foto');

            $fotoNome = $this->validaImagem($foto, $user);

            $user->foto = $fotoNome;
        }

        if($user->update()){
            return redirect('/painel/user')->with('sucesso', 'Dados do usuário editados com sucesso!');
        }else{
            return redirect('/painel/user')->with('erro', 'Ocorreu algum erro ao editar os dados do usuário, tente novamente mais tarde!');
        }

    }

    public function delete($id){

        if(auth()->user()->id != $id) {

            $user = $this->user->find($id);

            if ($user->delete()) {
                return redirect('/painel/user')->with('sucesso', 'Usuario deletado com sucesso!');
            } else {
                return redirect('/painel/user')->with('erro', 'Erro ao deletar o usuário, tente novamente mais tarde!');
            }

        }else{

            return redirect('/painel/user')->with('erro', 'Você esta logado com este usuário, portanto não pode excluir o mesmo!!!');

        }

    }

    public function validaImagem($foto, $user){

        $extensao = $foto->getClientOriginalExtension();

        if(!in_array($extensao, $this->extensoes)){
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos .jpg ou .png');
        }else{

            $img_name = 'user_id_'.$user->id.'_'.$foto->getClientOriginalName();

            $path =  base_path() . '/public/assets/all/imagens_user/';

            $foto->move($path, $img_name);

            return '/assets/all/imagens_user/'.$img_name;

        }
    }
}