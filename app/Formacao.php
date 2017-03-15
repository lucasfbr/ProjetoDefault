<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class Formacao extends Model
{
    protected $fillable = [
        'user_id',
        'titulo',
        'conteudo',
        'link',
        'dataFormacao'
        ];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function getDataFormacaoAttribute($value){

        return  Carbon::parse($value)->format('d/m/Y');

    }

    public function setDataFormacaoAttribute($value){

        $this->attributes['dataFormacao'] = Carbon::parse($value)->format('y/d/m');

    }

}
