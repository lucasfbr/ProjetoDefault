<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortifolioController extends Controller
{
    public function index(){

        return view('painel.portifolio.index');

    }
}
