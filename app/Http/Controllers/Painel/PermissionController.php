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
        $this->permission = $permission;
    }

    public function index(){

        $permissions = $this->permission->all();

        return view('painel.permission.index', ['permissions' => $permissions]);

    }

   public function add(){
        
       return view('painel.permission.add');
       
   }

   public function create(Request $request){

       $this->validate($request, [
           'name' => 'required',
           'descricao' => 'required'
       ]);
       
       $permission = new Permission;

       $permission->name = $request->input('name');
       $permission->label = $request->input('descricao');

       if($permission->save()){
           return redirect('/painel/permission')->with('sucesso', 'Permissão cadastrado com sucesso!' );
       }else{
           return redirect('/painel/permission')->with('erro', 'Erro ao cadastrar uma nova permissão, tente novamente mais tarde!');
       }
       
   }

   public function edit($id){

       $permission =  $this->permission->find($id);

       return view('painel.permission.edit', compact('permission'));
   }

   public function update(Request $request, $id){

       $this->validate($request, [
           'name' => 'required',
           'descricao' => 'required'
       ]);

       $permission =  $this->permission->find($id);

       $permission->name = $request->input('name');
       $permission->label = $request->input('descricao');

       if($permission->update()){
           return redirect('/painel/permission')->with('sucesso', 'Permissão editada com sucesso!' );
       }else{
           return redirect('/painel/permission')->with('erro', 'Erro ao editar a permissão, tente novamente mais tarde!');
       }

   }

   public function delete($id){

       $permission =  $this->permission->find($id);

       if($permission->delete()){
           return redirect('/painel/permission')->with('sucesso', 'Permissão deletada com sucesso!' );
       }else{
           return redirect('/painel/permission')->with('erro', 'Erro ao deletar a permissão, tente novamente mais tarde!');
       }

   }

}
