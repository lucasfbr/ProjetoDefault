<?php

namespace App\Http\Controllers\Painel;

use App\Role;
use App\User;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{

    private $user;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = 'img/usuarios/';
    private $caminhoImgPerfil = 'img/perfil/';

    public function __construct(User $user)
    {
        //$this->middleware('auth');

        $this->user = $user;
    }

    public function index(){

        $users = User::with('perfis')->get();

        return view('painel.user.index', ['users' => $users]);

    }

    public function consultores($service_id, Service $service){

        $servico = $service->find($service_id);

        //$users = User::with('service')->where('id', $service_id)->get();

        $users = $servico->user;

        dd($users);

        //$users = $servico->user;

        return view('painel.user.cliente.index', compact('users','servico'));

    }

    //metodo que responderá a requisição ajax vinda do vuejs
    //retorna um objeto json
    public function listUser(){

        $data = User::with('perfis')->orderBy('name', 'asc')->get();

        return response()->json($data);

    }

    public function detail($id){

        $user = $this->user->find($id);

        $perfil = $user->perfis;

        $formacao = $user->formacao;

        return view('painel.user.detail', ['user' => $user, 'perfil' => $perfil, 'formacao' => $formacao]);

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

            if(!$userPerfil->perfis()->create($request->all())){
                return redirect('/painel/user')->with('erro', 'Ocorreu algum erro ao cadastrar o perfil do usuário, tente novamente mais tarde!');
            }

            if(!empty($request->file('foto_perfil'))){

                //armazena a imagem enviada pelo form
                $image = $request->file('foto_perfil');
                //pega a extensao da imagem
                $extensao = $image->getClientOriginalExtension();
                //recebe o nome da imagem que foi movida para a pasta de destino
                $foto_perfil = $this->moverImagemPerfil($image, $extensao);

                $userPerfil->perfis()->update(['foto_perfil' => $foto_perfil]);
            }

            return redirect('/painel/user')->with('sucesso', 'Usuário cadastrado com sucesso!');
        }else{
            return redirect('/painel/user')->with('erro', 'Ocorreu algum erro ao cadastrar um novo usuário, tente novamente mais tarde!');
        }

    }

    public function edit(Request $request, $id){

        $user = $this->user->find($id);

        $perfil = $user->perfis;

        return view('painel.user.edit', ['user' => $user, 'perfil' => $perfil]);

    }

    public function update(Request $request, $id){

        $dados = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ];

        if($request->input('password')){
            $dados = array_add($dados, 'password', 'required|min:6|confirmed');
        }

        $this->validate($request, $dados);

        $user = $this->user->find($id);

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
        $user->tipo = $request->input('tipo');
        $user->usuarioPrincipal = $request->input('usuarioPrincipal');

        if($user->update()){

            $perfil = $user->perfis;

            if($perfil) {

                if(!empty($request->file('foto_perfil'))){

                    //armazena a imagem enviada pelo form
                    $image = $request->file('foto_perfil');
                    //pega a extensao da imagem
                    $extensao = $image->getClientOriginalExtension();
                    //recebe o nome da imagem que foi movida para a pasta de destino
                    $foto_perfil = $this->moverImagemPerfil($image, $extensao);

                    $perfil->foto_perfil = $foto_perfil;
                }

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
                    return redirect('/painel/user')->with('erro', 'Ocorreu algum erro ao editar o perfil do usuário, tente novamente mais tarde!');
                }

            }else{

                if(!empty($request->file('foto_perfil'))){

                    //armazena a imagem enviada pelo form
                    $image = $request->file('foto_perfil');
                    //pega a extensao da imagem
                    $extensao = $image->getClientOriginalExtension();
                    //recebe o nome da imagem que foi movida para a pasta de destino
                    $foto_perfil = $this->moverImagemPerfil($image, $extensao);
                }

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
                    'notas' => $request->input('notas'),
                    'foto_perfil' => $foto_perfil,
                ]);
            }


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



    public function userRole(){

        $users = $this->user->all();

        return view('painel.user.user', compact('users'));

    }

    public function userRoleShow($id){

        $user = $this->user->find($id);

        $roles = $user->roles;

        $totalRoles = Role::all();

        return view('painel.user.role', compact('user','roles','totalRoles'));

    }

    public function roleAdd($id){

        $user = $this->user->find($id);

        $roles = Role::all();

        return view('painel.user.roleAdd', compact('user','roles'));

    }

    public function roleCreate(Request $request, $id){

        $this->validate($request, [
            'grupo' => 'required',
        ]);

        $user = $this->user->find($id);

        $role_id = $request->input('grupo');

        $user->roles()->attach($role_id);

        if($user->save()){
            return redirect('/painel/user/role/show/'.$id)->with('sucesso', 'Usuário adicionado ao grupo com sucesso' );
        }else{
            return redirect('/painel/user/role/show/'.$id)->with('erro', 'Erro ao adicionar o usuário em um grupo, tente novamente mais tarde!');
        }

    }

    public function userRoleDelete($id,$role_id){

        $user = $this->user->find($id);

        $user->roles()->detach($role_id);

        if($user->save()){
            return redirect('/painel/user/role/show/'.$id)->with('sucesso', 'Usuário removido do grupo com sucesso' );
        }else{
            return redirect('/painel/user/role/show/'.$id)->with('erro', 'Erro ao remover o usuário do grupo, tente novamente mais tarde!');
        }

    }

    public function addUserService(Request $request, $user_id){


        /*
         * PERMISSÃO DO USUÁRIO
         *
         * Cadastrar areas de atuação do consultor
         *
         * verifica a permissão do usuário
         * se usuario autorizado segue o código, caso contrário retorna para página anterior
         */
        if(Gate::denies('add_atuacao'))
            return redirect()->back()->with('erro', 'Você não tem permissão para visualizar esta página, entre em contato com o administrador do site!');


        $this->validate($request, [
            'services' => 'required',
        ]);

        $user = $this->user->find($user_id);

        $services = $request->input('services');

        if($user->service()->sync($services)){
            return redirect('/painel/perfil/')->with('sucesso', 'Cadastro de consultorias feito com sucesso' );
        }else{
            return redirect('/painel/perfil/')->with('erro', 'Erro ao fazer o cadstro de suas consultorias, tente novamente mais tarde!');
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

    public function moverImagemPerfil($image, $extensao){

        if(!in_array($extensao, $this->extensoes)) {
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos jpg, jpeg e png');
        } else {

            $filename = 'perfil' . time() . '.' . $extensao;

            $path = public_path($this->caminhoImgPerfil . $filename);

            Image::make($image->getRealPath())->resize(390,460)->save($path);

            return $this->caminhoImgPerfil . $filename;

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
