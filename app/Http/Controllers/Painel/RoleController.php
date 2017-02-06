<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;

class RoleController extends Controller
{

    private $role;

    public function __construct(Role $role)
    {
        $this->middleware('auth');

        $this->role = $role;
    }

    public function index(){

        $roles = $this->role->all();

        return view('painel.role.index', ['roles' => $roles]);

    }

}
