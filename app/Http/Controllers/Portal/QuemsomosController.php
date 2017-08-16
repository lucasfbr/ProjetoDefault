<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;

class QuemsomosController extends Controller
{
    public function index(){


        $usuarioPrincipal = User::where('usuarioPrincipal', '1')->get();

        $user = $usuarioPrincipal->find($usuarioPrincipal[0]->id);

        $perfil = $user->perfis;

        $formacao = $user->formacao;

        return view('portal.quem-somos.index', ['perfil'=>$perfil, 'formacao'=>$formacao]);

    }
}
