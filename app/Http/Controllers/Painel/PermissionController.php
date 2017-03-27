<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;

class PermissionController extends Controller
{

    private $permission;

    public function __construct(Permission $permission)
    {
        $this->middleware('auth');

        $this->permission = $permission;
    }

    public function index(){

        $permissions = $this->permission->all();

        return view('painel.permission.index', ['permissions' => $permissions]);

    }

    public function debug(){

        $nameuser = auth()->user()->name;

        var_dump("<h1>".$nameuser."</h1>");

        foreach (auth()->user()->roles as $role) {

            echo $role->name . ' -> ';

            $permissions = $role->permissions;

            foreach ($permissions as $permission){
                echo $permission->name . ',';
            }

            echo "<hr>";

        }

    }

}
