<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['user_id','titulo'];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function post(){

        return $this->hasMany(Post::class);

    }

}
