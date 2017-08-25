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

    public function getDataEntradaAttribute($value){

        return  Carbon::parse($value)->format('d/m/Y');

    }

    public function getDataSaidaAttribute($value){

        return  Carbon::parse($value)->format('d/m/Y');

    }


   public function setDataEntradaAttribute($value){

       $objDate = \DateTime::createFromFormat('d/m/Y', $value);

       $this->attributes['data_entrada'] = $objDate->format('Y-m-d');

    }

    public function setDataSaidaAttribute($value){

        $objDate = \DateTime::createFromFormat('d/m/Y', $value);

        $this->attributes['data_saida'] = $objDate->format('Y-m-d');

    }


}
