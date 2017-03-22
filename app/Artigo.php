<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    protected $fillable = [
        'user_id','titulo','conteudo','imagem', 'published_at'
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

    public function user(){

        return $this->belongsTo(User::class);

    }

   public function setPublishedAtAttribute($date){

        $this->attributes['published_at'] = Carbon::parse($date)->format('Y-m-d');

   }

    public function getPublishedAtAttribute($date){

        return Carbon::parse($date)->format('d-m-Y');

    }
}
