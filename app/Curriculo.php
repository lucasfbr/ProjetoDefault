<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Curriculo extends Model
{
    protected $fillable = [
        'empresa',
        'cargo',
        'data_entrada',
        'data_saida'
    ];

    public function user(){

        return $this->belongsTo(User::class);

    }

}
