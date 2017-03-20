<?php

namespace App\Http\Controllers\Campus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        return view('campus.home.index');

    }
}
