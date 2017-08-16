<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Perfil extends Model
{


    protected $fillable = [
         'user_id',
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
         'sexo',
         'profissao',
         'empresa',
         'resumo',
         'descricao',
         'foto_perfil',
         'habilidades',
         'notas',
         'experienciaLean',
         'experienciaConsultor'
    ];


    public function user(){

        return $this->belongsTo(User::class);

    }

    public function experienciaProfissional(){

        return $this->hasMany(Eperienciaprofissional::class);

    }

}
