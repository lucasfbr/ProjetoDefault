<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{

    protected $fillable = [
        'user_id','titulo','conteudo','img_p','img_g'
    ];

    public function user(){

        return $this->belongsTo(User::class);

    }

    //public function getConteudoAttribute($value){

        //return mb_strimwidth("$value", 0, 500, "...");

    //}
}
