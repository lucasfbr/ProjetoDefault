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