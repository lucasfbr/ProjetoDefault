<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Experienciasprofissionais;
use App\Perfil;
use App\User;

class ExperienciasprofissionaisController extends Controller
{
    protected $experiencia;

    public function __construct(Experienciasprofissionais $experiencia){

        $this->experiencia = $experiencia;

    }

    public function find($id){


        $user = new User();

        $user = $user->find($id);

        $dados = $user->perfis->experienciaProfissional;

        return response()->json($dados);

    }

    public function create(Request $request){

        $dados = $request->all();

        $total = count($dados);

        for($i=0; $i<$total; $i++){

           $exp = new Experienciasprofissionais();

           $id_experiencia = isset($dados[$i]['id'])  ? $dados[$i]['id'] : '';

           //verifica se existe o id da experiencia, caso exista, confirma no banco sua existencia e retorna false
           //caso não exista retorna true
           $validaExp = $id_experiencia != '' ? $this->verificaExistenciaExperiencia($id_experiencia) : true;

           if($validaExp) {

               $exp->perfil_id = $dados[$i]['perfil_id'];
               $exp->empresa = $dados[$i]['empresa'];
               $exp->cargo = $dados[$i]['cargo'];
               $exp->data_entrada = $dados[$i]['dataEntrada'];
               $exp->data_saida = $dados[$i]['dataSaida'];

               $exp->save();

           }

       }

       return response()->json($dados);

    }

    public function delete($id){

        $exp = $this->experiencia->find($id);

        if($exp->delete()){

            return response()->json(true);

        }else{

            return response()->json(false);
        }

    }

    public function verificaExistenciaExperiencia($expId){

        //faz uma busca pelo id da experiencia, caso exista retorna false
        //isso vai impedir o recadastramento de um experiencia ja existente
        $experiencia = $this->experiencia->find($expId);

        if($experiencia)
            return false;
        else
            //caso retorne true a experiencia deve ser cadastrada
            return true;



    }
}
