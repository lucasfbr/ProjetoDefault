<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{

    private $banner;
    private $extensoes = ['jpg','jpeg', 'png'];
    private $caminhoImg = 'img/banners/';

    public function __construct(Banner $banner){

        $this->banner = $banner;
    }


    public function create(Request $request){


        $this->validate($request, [
            'banner' => 'required',
        ]);


        $banner = new Banner;

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('banner'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('banner');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $banner->banner = $this->moverImagem($image, $extensao);
        }

        $banner->titulo = $request->input('titulo');
        $banner->descricao = $request->input('descricao');

        if($banner->save()){
            return redirect('/painel/configuracoes')->with('sucesso', 'Banner cadastrado com sucesso!');
        }else{
            return redirect('/painel/configuracoes')->with('erro', 'Erro ao cadastrar o banners, tente novamente mais tarde!');
        }

    }

    public function update(Request $request, $id){

        $banner = $this->banner->find($id);

        //verifica se foi enviada alguma imagem com o formulário
        if(!empty($request->file('banner'))){

            //armazena a imagem enviada pelo form
            $image = $request->file('banner');
            //pega a extensao da imagem
            $extensao = $image->getClientOriginalExtension();
            //recebe o nome da imagem que foi movida para a pasta de destino
            $banner->banner = $this->moverImagem($image, $extensao);
        }

        $banner->titulo = $request->input('titulo');
        $banner->descricao = $request->input('descricao');

        if(empty($request->input('status'))) {
            $banner->status = '0';
        }else{
            $banner->status = $request->input('status');
        }

        if($banner->update()){
            return redirect('/painel/configuracoes')->with('sucesso', 'Banner editado com sucesso!');
        }else{
            return redirect('/painel/configuracoes')->with('erro', 'Erro ao editar o banner, tente novamente mais tarde!');
        }



    }

    public function delete($id){

        $banner = $this->banner->find($id);

        if($banner->delete($id)){
            //metodo que verifica se a imagem salva no banco exite no diretorio
            //caso exista remove a mesma do diretorio
            $this->removeImagemDir($banner->banner);

            return redirect('/painel/configuracoes')->with('sucesso', 'Banner deletado com sucesso!');
        }else{
            return redirect('/painel/configuracoes')->with('erro', 'Erro ao deletar o banner, tente novamente mais tarde!');
        }

    }

    /*
    * Metodo responsavel por verificar a extensao, redimencionar e mover a imagem para seu destino
    */
    public function moverImagem($image, $extensao){

        if(!in_array($extensao, $this->extensoes)) {
            return back()->with('erro', 'Erro ao fazer upload de imagem! Formatos aceitos jpg, jpeg e png');
        } else {

            $filename = 'banners' . time() . '.' . $extensao;

            $path = public_path($this->caminhoImg . $filename);

            Image::make($image->getRealPath())->resize(2500,600)->save($path);

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
