<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Service;
use App\Portifolio;
use App\Quemsomos;

class HomeController extends Controller
{
    private $servico;

    public function index(){

        $serv = new Service;

        $servicos = $serv::where('status', '1')->take(4)->get();

        $port = new Portifolio;

        $portifolio = $port::where('status', '1')->take(4)->get();

        $quem = new Quemsomos();

        $quemsomos = $quem::where('status', '1')->take(1)->get();

        return view('portal.home.index', ['servicos' => $servicos, 'portifolio' => $portifolio, 'quemsomos' => $quemsomos]);

    }

}
