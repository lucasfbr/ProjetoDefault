<?php

use App\Configuracoes;

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
    $dados['google'] = '';
    $dados['facebook'] = '';
    $dados['youtube'] = '';
    $dados['skype'] = '';
    $dados['twitter'] = '';
    $dados['linkedin'] = '';

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

        $dados['redesSociais'] = array(
            array(
                'google' => $config[0]->google,
                'facebook' => $config[0]->facebook,),
            array(
                'youtube' => $config[0]->youtube,
                'skype' => $config[0]->skype,),
            array(
                'twitter' => $config[0]->twitter,
                'linkedin' => $config[0]->linkedin)
        );



        /*

        $dados['google'] = $config[0]->google;
        $dados['facebook'] = $config[0]->facebook;
        $dados['youtube'] = $config[0]->youtube;
        $dados['skype'] = $config[0]->skype;
        $dados['twitter'] = $config[0]->twitter;
        $dados['linkedin'] = $config[0]->linkedin;
        */
    }

    //print_r($dados['redesSociais']);exit;

    return (object) $dados;

}