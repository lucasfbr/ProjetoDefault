<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Artigo;

class ArtigoController extends Controller
{
    public function index(){

        $artigos = Artigo::latest('published_at')->published()->get();

        dd($artigos);

        return view('portal.artigo.index', compact('artigos'));

    }

    public function show($id){

        $artigo = Artigo::find($id)->published()->get();

        return view('portal.artigo.show', compact('artigo'));

    }
}
