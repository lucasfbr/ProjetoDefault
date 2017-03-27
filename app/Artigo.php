<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Artigo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'categoria_id', 'titulo','conteudo','imagem','published_at'
    ];

    protected  $dates = [
        'created_at',
        'updated_at',
        'published_at',
        'deleted_at',
    ];

    public function scopePublished($query){

        $query->where('published_at', '<=', Carbon::now());

    }

    public function scopeUnpublished($query){

        $query->where('published_at', '>', Carbon::now());

    }

    public function setPublishedAtAttribute($value){

        $objDate = \DateTime::createFromFormat('d/m/Y H:i', $value);

        $this->attributes['published_at'] = $objDate->format('Y-m-d H:i:s');

    }

    public function getPublishedAtAttribute($date){

        return Carbon::parse($date)->format('d-m-Y H:i');
    }

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function categoria(){

        return $this->belongsTo(Categoria::class);

    }
}
