<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Perfil extends Model
{


    protected $fillable = [
         'user_id',
         'resumo',
         'descricao',
         'ddd',
         'fone',
         'celular',
         'cep',
         'estado',
         'cidade',
         'bairro',
         'logradouro',
         'numero',
         'complemento',
         'profissao',
         'empresa',
         'sexo',
         'habilidades',
         'notas'
    ];


    public function user(){

        return $this->belongsTo(User::class);

    }

}
