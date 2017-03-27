<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;

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

    public function role($id){

        $role = $this->role->find($id);

        $permissions = $role->permissions;

        return view('painel.role.show', compact('role','permissions'));

    }



}
