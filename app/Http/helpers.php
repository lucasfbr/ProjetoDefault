<?php

use App\Configuracoes;
use App\User;

function info_sistem()
{
    $dados = array();

    $dados['logo'] = '';
    $dados['titulo'] = '';
    $dados['logradouro'] = '';
    $dados['numero'] = '';
    $dados['bairro'] = '';
    $dados['cidade'] = '';
    $dados['uf'] = '';
    $dados['cep'] = '';
    $dados['telefone'] = '';
    $dados['googlemaps'] = '';
    $dados['redesSociais'] = '';
    $dados['termosDeContrato'] = '';

    $config = Configuracoes::all();

    if(count($config) > 0){

        $dados['logo'] = $config[0]->logo;
        $dados['titulo'] = $config[0]->titulo;
        $dados['logradouro'] = $config[0]->logradouro;
        $dados['numero'] = $config[0]->numero;
        $dados['bairro'] = $config[0]->bairro;
        $dados['cidade'] = $config[0]->cidade;
        $dados['uf'] = $config[0]->uf;
        $dados['cep'] = $config[0]->cep;
        $dados['telefone'] = $config[0]->telefone;
        $dados['googlemaps'] = $config[0]->googlemaps;
        $dados['termosDeContrato'] = $config[0]->termosDeContrato;

        if($config[0]->google || $config[0]->facebook || $config[0]->youtube || $config[0]->skype || $config[0]->twitter || $config[0]->linkedin) {

            $dados['redesSociais'] = array(
                array(
                    'facebook' => $config[0]->facebook,
                    'twitter' => $config[0]->twitter
                ),
                array(
                    'linkedin' => $config[0]->linkedin,
                    'skype' => $config[0]->skype,
                    ),
                array(
                    'google' => $config[0]->google,
                    'youtube' => $config[0]->youtube
                )
            );
        }

    }

    //print_r($dados['redesSociais']);exit;

    return (object) $dados;

}

function genero($valor){

    if($valor === 'm'){
        $sexo = 'Masculino';
    }else{
        $sexo = 'Feminino';
    }

    return $sexo;

}

//metodo que separa as strings na virgula utilizando o
//explode do php
function stringToArray($value){

    $habilidades = explode(",", $value);

    return $habilidades;

}

function usuarioPrincipal(){

    $array['name'] = '';
    $array['email'] = '';

    $user = new User();

    $userPricipal = $user::where('usuarioPrincipal', '1')->get();

    if(count($userPricipal) > 0) {
        $array['name'] = $userPricipal[0]->name;
        $array['email'] = $userPricipal[0]->email;
    }

    return (object) $array;
}

function totalConsultores(){

    $user = new User();

    $consultores = $user::where('tipo', '1')->count();

    return $consultores;

}

function formatarExpProfissional($experiencia){

    if($experiencia){
        return $experiencia[0] . ' anos ' . $experiencia[1] . ' meses ' . $experiencia[1] . ' dias';
    }

}

/*
 * $expPro = array
 * $expCons = int
 * $expLean = int
 */
function valorHora($expPro, $expCons, $expLean){

    $anos = array();
    $peso = array();
    $vazio = 'Nenhum valor definido';

    if(($expPro) ||  ($expCons) || ($expLean)){

        //$expPro[0] = anos
        //$expPro[1] = meses
        //$expPro[2] = dias
        $anos[] = $expPro[0];
        $anos[] = intval($expCons);
        $anos[] = intval($expLean);

        //dd($anos);

        //Anos de experiencia profissional
        if($anos[0]){

            if($anos[0] <= 5) {
                $peso['expProfissional'] = 1;
            }elseif(($anos[0] > 5) AND ($anos[0] <= 10)) {
                $peso['expProfissional'] = 3;
            }elseif(($anos[0] > 10) AND ($anos[0] <= 15)) {
                $peso['expProfissional'] = 5;
            }else{
                $peso['expProfissional'] = 9;
            }

        }
        //Anos de experiencia como consultor
        if($anos[1]){

            if($anos[1] == 1) {
                $peso['expConsultor'] = 1;
            }elseif(($anos[1] >= 2) AND ($anos[1] <= 5)) {
                $peso['expConsultor'] = 3;
            }elseif(($anos[1] > 5) AND ($anos[1] <= 10)) {
                $peso['expConsultor'] = 5;
            }else {
                $peso['expConsultor'] = 9;
            }

        }
        //Anos de experiencia com LEAN
        if($anos[2]){

            if($anos[2] <= 3) {
                $peso['expLean'] = 1;
            }elseif($anos[2] > 3 AND $anos[2] <= 5) {
                $peso['expLean'] = 3;
            }elseif($anos[2] > 5 AND $anos[2] <= 10) {
                $peso['expLean'] = 5;
            }else {
                $peso['expLean'] = 9;
            }

        }

        //recebe o retorno da funcao faixasDeValores que retorna
        //o valor a ser cobrado por hora, com base nos pesos das experiecias enviadas
        $valorHora = faixasDeValores($peso);

        return 'R$ ' . $valorHora;

    }else{

        return $vazio;

    }

}

/*
 * $peso = array
 *
 * $peso conterá os pesos de cada experiencia.
 * $peso[expProfissional] = peso experiencia profissional
 * $peso[expConsultor] = ṕeso experiencia como consultor
 * $peso[expLean] = peso experiencia com LEAN
 *
 */
function faixasDeValores($peso){

    $total = array_sum($peso);


    if($total <= 8){
        $valor = 100;
    }elseif(($total > 8) OR ($total <= 12)){
        $valor = 150;
    }elseif(($total > 12) OR ($total <= 16)){
        $valor = 200;
    }elseif(($total > 16) OR ($total <= 20)){
        $valor = 300;
    }elseif(($total > 20) OR ($total <= 28)){
        $valor = 400;
    }elseif(($total > 28) OR ($total <= 35)){
        $valor = 500;
    }else{
        $valor = 600;
    }

    return number_format($valor , 2, ',', '.');



}

