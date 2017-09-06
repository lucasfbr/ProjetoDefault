<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projetos extends Model
{

    public function user(){

        return $this->belongsToMany(User::class);

    }

}
