<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'titulo','texto','imagem','imagem_descricao'
    ];

    public function user(){

        return $this->belongsToMany(User::class);

    }
}
