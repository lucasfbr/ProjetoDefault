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
         'logradouro',
         'numero',
         'complemento',
         'profissao',
         'empresa',
         'sexo',
         'formacao',
         'habilidades',
         'notas'
    ];


    public function user(){

        return $this->belongsTo(User::class);

    }

}
