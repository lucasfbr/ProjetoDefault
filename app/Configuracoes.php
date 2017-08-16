<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracoes extends Model
{
    protected $fillable = [
        'logo',
        'titulo',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'telefone',
        'googlemaps',
        'facebook',
        'youtube',
        'skype',
        'twitter',
        'linkedin',
        'google'
    ];
}
