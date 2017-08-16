<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Service;


class HomeController extends Controller
{

    private $service;

    public function __construct(Service $service){

        $this->service = $service;

    }


    public function index()
    {

        $tipoUser = Auth::user()->tipo;

        if($tipoUser == 'Cliente') {

            $servicos = $this->service->all();

            return view('painel.home.cliente.index', compact('servicos'));

        }

        if($tipoUser == 'Consultor'){

            return view('painel.home.consultor.index');

        }

        return view('painel.home.admin.index');
    }



}
