<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Service;


class ServicosController extends Controller
{
    private $servico;

    public function __construct(Service $service){

        $this->servico = $service;

    }

    public function index(){

        $servicos = $this->servico->all();

        return view('portal.servico.index', ['servicos' => $servicos]);

    }
}
