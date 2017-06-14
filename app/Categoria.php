<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Categoria extends Model
{
    protected $fillable = ['titulo','descricao'];


    public function artigo(){

        return $this->hasMany(Artigo::class);

    }

}
