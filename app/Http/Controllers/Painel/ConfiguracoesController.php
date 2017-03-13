<?php

namespace App\Http\Controllers\Painel;

use App\Configuracoes;
use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;


class ConfiguracoesController extends Controller
{

    private $config;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = '/img/';

    public function __construct(Configuracoes $config)
    {
        $this->config = $config;
    }

    public function index(){

        $config = $this->config->find('1');

        $banners = Banner::all();

        return view('painel.configuracoes.index', ['dados' => $config, 'banners' => $banners]);

    }

    public function update(Request $request, $id, $tipo){

        $config = $this->config->find($id);

        //verifica qual o formulario esta sendo enviado
        //1 = cabecalho e rodape
        //2 = formas de pagamento
        //3 = redes sociais e google maps
        //4 = termos de contrato
        if($tipo == '1'){

            //verifica se foi enviada alguma imagem com o formulário
            if($request->file('logo')){

                $image = $request->file('logo');

                $extensao = $image->getClientOriginalExtension();

                if(!in_array($extensao, $this->extensoes)) {
                    return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos jpg, jpeg e png');
                } else {

                    $filename = 'logo_' . time() . '.' . $extensao;

                    $path = public_path($this->caminhoImg . $filename);

                    Image::make($image->getRealPath())->resize(100, 50)->save($path);

                    $config->logo = $this->caminhoImg . $filename;

                    $config->save();
                }
            }

            $config->titulo = $request->input('titulo');
            $config->logradouro = $request->input('logradouro');
            $config->numero = $request->input('numero');
            $config->bairro = $request->input('bairro');
            $config->cidade = $request->input('cidade');
            $config->uf = $request->input('uf');
            $config->cep = $request->input('cep');
            $config->telefone = $request->input('telefone');

        }elseif ($tipo == '2'){

            $config->googlemaps = $request->input('googlemaps');
            $config->facebook = $request->input('facebook');
            $config->youtube = $request->input('youtube');
            $config->skype = $request->input('skype');
            $config->twitter = $request->input('twitter');
            $config->linkedin = $request->input('linkedin');
            $config->google = $request->input('google');

        }elseif ($tipo == '3'){

            $config->termosDeContrato = $request->input('termosDeContrato');

        }

        if($config->update()){
            return redirect('painel/configuracoes')->with('sucesso', 'Configuração salva com sucesso!');
        }else{
            return redirect('painel/configuracoes')->with('erro', 'Ocorreu algum erro ao salvar os dados, tente novamente mais tarde.');
        }

    }


}
