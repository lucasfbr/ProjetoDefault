<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Portifolio;

class PortifolioController extends Controller
{

    private $portifolio;

    public function __construct(Portifolio $portifolio){

        $this->portifolio = $portifolio;
    }

    public function index(){

        $portifolio = $this->portifolio->all();

        return view('portal.portifolio.index', ['portifolio' => $portifolio]);

    }
}
