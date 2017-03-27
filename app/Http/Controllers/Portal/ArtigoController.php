<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Artigo;

class ArtigoController extends Controller
{
    public function __construct(){
        \Carbon\Carbon::setLocale('pt_BR');
    }

    public function index(){

        $artigos = artigo::latest('published_at')->published()->with('user')->paginate(6);

        return view('portal.artigo.index', compact('artigos'));

    }

    public function show($id){

        $artigo = artigo::find($id);

        return view('portal.artigo.show', compact('artigo'));

    }
}
