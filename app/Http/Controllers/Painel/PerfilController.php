<?php

namespace App\Http\Controllers\Painel;

use App\Perfil;
use App\User;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class PerfilController extends Controller
{
    private $user;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = 'img/usuarios/';
    private $caminhoImgPerfil = 'img/perfil/';

    public function __construct(User $user, Service $service, Perfil $perfil)
    {
        $this->user = $user;
        $this->service = $service;
        $this->perfil = $perfil;
    }

    public function index($id){


        $user = $this->user->find($id);

        //busca o perfil do usuario
        $perfil = $user->perfis;

        //dd($user->perfis->experienciaProfissional);

        $experienciaProfissional = $user->tipo == 'Administrador' || $user->tipo == 'Consultor' ? $this->totalExperienciaProfissional($user->perfis->experienciaProfissional) : '';

        //busca todas as formações do usuario
        $formacao = $user->formacao();

        //busca todos os servicos para criar os checkbox na aba "Áreas de atuação"
        $services = $this->service->all();

        //busca todos os servicos vinculados ao usuario
        $userService = $user->service();

        return view('painel.perfil.index', compact('user','perfil','formacao','services','userService', 'experienciaProfissional'));

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
        if($user->tipo == 'Administrador' || $user->tipo == 'Consultor'){
            $dados = array_add($dados, 'habilidades', 'required');
            $dados = array_add($dados, 'experienciaLean', 'required');
            $dados = array_add($dados, 'experienciaConsultor', 'required');
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
                }else{
                    $perfil->foto_perfil = '';
                }

                $perfil->resumo = $request->input('resumo') ? $request->input('resumo') : '';
                $perfil->descricao = $request->input('descricao') ? $request->input('descricao') : '';
                $perfil->fone = $request->input('fone') ? $request->input('fone') : '';
                $perfil->celular = $request->input('celular') ? $request->input('celular') : '';
                $perfil->cep = $request->input('cep') ? $request->input('cep') : '';
                $perfil->estado = $request->input('estado') ? $request->input('estado') : '';
                $perfil->cidade = $request->input('cidade') ? $request->input('cidade') : '';
                $perfil->bairro = $request->input('bairro') ? $request->input('bairro') : '';
                $perfil->logradouro = $request->input('logradouro') ? $request->input('logradouro') : '';
                $perfil->numero = $request->input('numero') ? $request->input('numero') : '0';
                $perfil->complemento = $request->input('complemento') ? $request->input('complemento') : '';
                $perfil->profissao = $request->input('profissao') ? $request->input('profissao') : '';
                $perfil->empresa = $request->input('empresa') ? $request->input('empresa') : '';
                $perfil->sexo = $request->input('sexo') ? $request->input('sexo') : '';
                $perfil->habilidades = $request->input('habilidades') ? $request->input('habilidades') : '';
                $perfil->notas = $request->input('notas') ? $request->input('notas') : '';
                $perfil->experienciaConsultor = $request->input('experienciaConsultor') ? $request->input('experienciaConsultor') : '';
                $perfil->experienciaLean = $request->input('experienciaLean') ? $request->input('experienciaLean') : '';

                if($perfil->update()) {

                    if ($user->perfil === 'Incompleto'){
                        $user->perfil = '1';
                        $user->update();
                    }

                }else{
                    return redirect('/painel/perfil/'.$id)->with('erro', 'Ocorreu algum erro ao editar o perfil do usuário, tente novamente mais tarde!')->with('settings', 'active');
                }

            }else{

                if(!empty($request->file('foto_perfil'))){

                    //armazena a imagem enviada pelo form
                    $image = $request->file('foto_perfil');
                    //pega a extensao da imagem
                    $extensao = $image->getClientOriginalExtension();
                    //recebe o nome da imagem que foi movida para a pasta de destino
                    $foto_perfil = $this->moverImagemPerfil($image, $extensao);
                }else{
                    $foto_perfil = '';
                }

                $cadPerfil = $user->perfis()->create([
                                'resumo' => $request->input('resumo') ? $request->input('resumo') : '',
                                'descricao' => $request->input('descricao') ? $request->input('descricao') : '',
                                'fone' => $request->input('fone') ? $request->input('fone') : '',
                                'celular' => $request->input('celular') ? $request->input('celular') : '',
                                'cep' => $request->input('cep') ? $request->input('cep') : '',
                                'estado' => $request->input('estado') ? $request->input('estado') : '',
                                'cidade' => $request->input('cidade') ? $request->input('cidade') : '',
                                'bairro' => $request->input('bairro') ? $request->input('bairro') : '',
                                'logradouro' => $request->input('logradouro') ? $request->input('logradouro') : '',
                                'numero' => $request->input('numero') ? $request->input('numero') : '0',
                                'complemento' => $request->input('complemento') ? $request->input('complemento') : '',
                                'profissao' => $request->input('profissao') ? $request->input('profissao') : '',
                                'empresa' => $request->input('empresa') ? $request->input('empresa') : '',
                                'sexo' => $request->input('sexo') ? $request->input('sexo') : '',
                                'habilidades' => $request->input('habilidades') ? $request->input('habilidades') : '',
                                'notas' => $request->input('notas') ? $request->input('notas') : '',
                                'foto_perfil' => $foto_perfil,
                                'experienciaConsultor' => $request->input('experienciaConsultor') ? $request->input('experienciaConsultor') : '',
                                'experienciaLean' => $request->input('experienciaLean') ? $request->input('experienciaLean') : '',
                            ]);
                 if($cadPerfil) {
                     $user->perfil = '1';
                     $user->update();
                 }else{
                     return redirect('/painel/perfil')->with('erro', 'Ocorreu algum erro ao criar o perfil do usuário, tente novamente mais tarde!')->with('settings', 'active');
                 }

            }

            return redirect('/painel/perfil/'.$id)->with('sucesso', 'Dados do perfil editados com sucesso!')->with('settings', 'active');
        }else{
            return redirect('/painel/perfil/'.$id)->with('erro', 'Ocorreu algum erro ao editar os dados do perfil, tente novamente mais tarde!')->with('settings', 'active');
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

    public function totalExperienciaProfissional($experiencias){


        if(count($experiencias) > 0) {

            $carbon = new Carbon();

            foreach ($experiencias as $exp) {

                $datasE = explode('/', $exp->data_entrada);
                $datasS = explode('/', $exp->data_saida);

                $dataInicial = $carbon::create($datasE[2], $datasE[1], $datasE[0]);
                $dataFinal = $carbon::create($datasS[2], $datasS[1], $datasS[0]);

                $diferencasY[] = $dataInicial->diff($dataFinal)->y;
                $diferencasM[] = $dataInicial->diff($dataFinal)->m;
                $diferencasD[] = $dataInicial->diff($dataFinal)->d;

            }


            $resultado = array_sum($diferencasY) . ' Anos ' . array_sum($diferencasM) . ' meses e ' . array_sum($diferencasD) . ' dias';

            return $resultado;

        }

        return '';


    }



}
