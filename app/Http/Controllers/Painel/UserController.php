<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $nome = auth()->user()->name;

        /*$roles = '';
        $p = '';

        foreach (auth()->user()->roles as $role){
            $roles[] = $role->name;

            $permissions = $role->permissions;

            foreach ($permissions as $per){

                $p[] = $per->name;
            }
        }*/

        return view('painel.user.index');

    }

}
