<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    protected $fillable = [
        'user_id','titulo','conteudo','imagem'
    ];

    public function user(){

        return $this->belongsTo(User::class);

    }
}
