<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;

class HomeController extends Controller
{
    public function index(){

        return view('portal.home.index');

    }

    public function listUser(){

        $user = new User();

        $list = $user->all();

        return response()->json($list);

    }
}
