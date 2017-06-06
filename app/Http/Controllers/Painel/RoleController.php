<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Permission;
use Illuminate\Support\Facades\App;

class RoleController extends Controller
{

    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index(){

        $roles = $this->role->orderBy('name', 'asc')->get();

        return view('painel.role.index', compact('roles'));

    }

    public function show($id){

        $role = $this->role->find($id);

        $permissions = $role->permissions->all();

        return view('painel.role.show', compact('role','permissions'));

    }

    public function add(){

        return view('painel.role.add');

    }

    public function create(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'descricao' => 'required'
        ]);

        $role = new Role();

        $role->name = $request->input('name');
        $role->label = $request->input('descricao');

        if($role->save()){
            return redirect('/painel/role')->with('sucesso', 'Grupo cadastrado com sucesso!' );
        }else{
            return redirect('/painel/role')->with('erro', 'Erro ao cadastrar um novo grupo, tente novamente mais tarde!');
        }

    }

    public function edit($id){

        $role = $this->role->find($id);

        return view('painel.role.edit', compact('role'));

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'name' => 'required',
            'descricao' => 'required'
        ]);

        $role = $this->role->find($id);

        $role->name = $request->input('name');
        $role->label = $request->input('descricao');

        if($role->update()){
            return redirect('/painel/role')->with('sucesso', 'Grupo editado com sucesso!' );
        }else{
            return redirect('/painel/role')->with('erro', 'Erro ao editar o grupo, tente novamente mais tarde!');
        }

    }

    public function delete($id){

        $role = $this->role->find($id);

        if($role->delete()){
            return redirect('/painel/role')->with('sucesso', 'Grupo deletado com sucesso!' );
        }else{
            return redirect('/painel/role')->with('erro', 'Erro ao deletar o grupo, tente novamente mais tarde!');
        }

    }

    public function addPermission($role_id){

        $role = $this->role->find($role_id);

        $permissions = Permission::all();

        return view('painel.role.addPermission', compact('role','permissions'));

    }

    public function createPermission(Request $request, $role_id){

        $this->validate($request, [
            'permissoes' => 'required',
        ]);

        $permission = $request->input('permissoes');
        $role       = $this->role->find($role_id);
        $role_permission =  $role->permissions()->sync($permission, false);

        if($role_permission){
            return redirect('/painel/role/show/'.$role->id)->with('sucesso', 'Permissões adicionadas com sucesso!' );
        }else{
            return redirect('/painel/role/show/'.$role->id)->with('erro', 'Erro ao adicionar as permissões, tente novamente mais tarde!');
        }

    }

    public function deletePermission($role_id, $permission_id){

        $role = $this->role->find($role_id);

        $delete = $role->permissions()->detach($permission_id);

        if($delete){
            return redirect('/painel/role/show/'.$role->id)->with('sucesso', 'Permissão desvinculada com sucesso!' );
        }else{
            return redirect('/painel/role/show/'.$role->id)->with('erro', 'Erro ao desvincular, tente novamente mais tarde!');
        }

    }



}
