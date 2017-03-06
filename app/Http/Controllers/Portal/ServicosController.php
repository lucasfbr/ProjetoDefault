<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


class ServicosController extends Controller
{
    public function index(){

        return view('portal.servico.index');

    }
}
