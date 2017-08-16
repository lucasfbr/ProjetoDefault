<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mensagem extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'nome', 'email', 'telefone', 'mensagem', 'resposta'
    ];

    protected  $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getCreatedAtAttribute($date){

        return Carbon::parse($date)->format('d/m/Y - H:i');
    }

    public function getUpdatedAtAttribute($date){

        return Carbon::parse($date)->format('d/m/Y - H:i');
    }



}
