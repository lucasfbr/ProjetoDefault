<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{

    protected $fillable = [
        'user_id','titulo','conteudo','imagem','published_at'
    ];

    protected  $dates = [
        'published_at',
        'created_at',
        'updated_at',
    ];

    public function scopePublished($query){

        $query->where('published_at', '<=', Carbon::now());

    }

    public function scopeUnpublished($query){

        $query->where('published_at', '>', Carbon::now());

    }

    public function setPublishedAtAttribute($date){

        dd(Carbon::createFromFormat('Y-m-d H:i', $date));

        //$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d H:i', $date);

    }

    public function getPublishedAtAttribute($date){

        return Carbon::parse($date)->format('d-m-Y');

    }

    public function user(){

        return $this->belongsTo(User::class);

    }

}
