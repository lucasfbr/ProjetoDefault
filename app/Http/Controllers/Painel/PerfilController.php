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

    public function formataHabilidades($value){

        $habilidades = explode(",", $value);

        return $habilidades;

    }
}
