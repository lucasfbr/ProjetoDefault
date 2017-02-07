<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class PerfilController extends Controller
{
    public function index(){

        return view('painel.perfil.index');

    }
}
