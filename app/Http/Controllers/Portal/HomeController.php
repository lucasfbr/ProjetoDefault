<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Service;
use App\Portifolio;
use App\Quemsomos;
use App\User;
use App\Banner;

class HomeController extends Controller
{

    public function index(){

        $banners = Banner::where('status','1')->take(3)->get();

        $servicos = Service::where('status', '1')->take(4)->get();

        $portifolio = Portifolio::where('status', '1')->take(4)->get();

        $quemsomos = Quemsomos::where('status', '1')->take(1)->get();

        $nossaEquipe = User::where('tipo', '1')->take(4)->with('perfis')->get();

        return view('portal.home.index',
            [
                'banners' => $banners,
                'servicos' => $servicos,
                'portifolio' => $portifolio,
                'quemsomos' => $quemsomos,
                'nossaEquipe' => $nossaEquipe
            ]);
    }

}
