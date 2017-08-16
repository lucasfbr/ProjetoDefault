<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Eperienciaprofissional extends Model
{
    protected $fillable = [
        'empresa',
        'cargo',
        'data_entrada',
        'data_saida'
    ];

    public function perfil(){

        return $this->belongsTo(User::class);

    }
}
