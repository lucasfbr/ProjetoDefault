<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categoria;

class CategoriaController extends Controller
{
    private $categoria;

    public function __construct(Categoria $categoria){

        $this->categoria = $categoria;

    }

    public function index(){

        //$categorias = $this->categoria->with('user')->paginate(6);
        $categorias = $this->categoria->paginate(10);

        return view('painel.categoria.index', compact('categorias'));

    }

    public function add(){

        return view('painel.categoria.add');

    }

    public function create(Request $request){

        $this->validate($request, [
            'titulo' => 'required',
            'descricao' => 'required',
        ]);

        $categoria = $this->categoria->create($request->all());

        if($categoria){
            return redirect('/painel/categoria/')->with('sucesso', 'Categoria cadastrada com sucesso!');
        }else{
            return redirect('/painel/categoria/')->with('erro', 'Erro ao cadastrar a categoria, tente novamente mais tarde!');
        }

    }

    public function edit($id){

        $categoria = $this->categoria->find($id);

        return view('painel.categoria.edit', compact('categoria'));

    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'titulo' => 'required',
            'descricao' => 'required',
        ]);

        $categoria = $this->categoria->find($id);

        $result = $categoria->update($request->all());

        if($result){
            return redirect('/painel/categoria/')->with('sucesso', 'Categoria editada com sucesso!');
        }else{
            return redirect('/painel/categoria/')->with('erro', 'Erro ao editar a categoria, tente novamente mais tarde!');
        }

    }

    public function delete($id){

        $categoria = $this->categoria->find($id);

        if($categoria->delete()){
            return redirect('/painel/categoria/')->with('sucesso', 'Categoria deletada com sucesso!');
        }else{
            return redirect('/painel/categoria/')->with('erro', 'Erro ao deletar a categoria, tente novamente mais tarde!');
        }

    }


}
