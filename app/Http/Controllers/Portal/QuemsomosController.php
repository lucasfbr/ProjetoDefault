<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class QuemsomosController extends Controller
{
    public function index(){

        return view('portal.quemsomos.index');

    }
}
