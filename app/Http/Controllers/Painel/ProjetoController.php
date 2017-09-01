<?php

namespace App\Http\Controllers\Painel;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Projetos;

class ProjetoController extends Controller
{

    protected $projetos;

    public function __construct(Projetos $projetos){

        $this->projetos = $projetos;

    }

    public function index(){

    }
}
