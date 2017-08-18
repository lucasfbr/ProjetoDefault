<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Experienciasprofissionais extends Model
{
    protected $fillable = [
        'perfil_id',
        'empresa',
        'cargo',
        'data_entrada',
        'data_saida'
    ];

    public function perfil(){

        return $this->belongsTo(User::class);

    }
}
