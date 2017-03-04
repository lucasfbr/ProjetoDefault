<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfiguracoesController extends Controller
{
    public function index(){

        return view('painel.configuracoes.index');

    }
}
