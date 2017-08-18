<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Experienciasprofissionais;

class ExperienciasprofissionaisController extends Controller
{


    public function all(){

        $exp = new Experienciasprofissionais();

        $dados = $exp->all();

        return response()->json($dados);

    }



    public function create(Request $request){

        $dados = $request->all();

        $total = count($dados);

        for($i=0; $i<$total; $i++){

           $exp = new Experienciasprofissionais();

           $exp->perfil_id = '1';
           $exp->empresa = $dados[$i]['empresa'];
           $exp->cargo = $dados[$i]['cargo'];
           $exp->data_entrada = '2017-01-01';
           $exp->data_saida = '2017-02-01';

           $exp->save();

       }


        return response()->json($total);

    }
}
