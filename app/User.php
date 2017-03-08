<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Permission;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ddd', 'fone', 'celular', 'cep', 'estado', 'cidade', 'logradouro', 'numero', 'complemento', 'profissao', 'empresa', 'sexo', 'foto', 'formacao', 'habilidades', 'notas', 'tipo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getCreatedAtAttribute($value){

        return  Carbon::parse($value)->format('d/m/Y');

    }


    public function getFotoAttribute($value){

        $fotoUsuario = '';

        if($value){
            $fotoUsuario = $value;
        }else{
            $fotoUsuario = '/img/default3.png';
        }

        return $fotoUsuario;

    }

    public function getTipoAttribute($value){

        $tipo = '';

        if($value == 0){
            $tipo = 'Administrador';
        }elseif ($value == 1){
            $tipo = 'Consultor';
        }else{
            $tipo = 'Cliente';
        }

        return $tipo;

    }

    public function getStatusAttribute($value){

        $status = '';

        if($value == 0){
            $status = 'Inativo';
        }else{
            $status = 'Ativo';
        }

        return $status;

    }

    public function getSexoAttribute($value){

        $sexo = '';

        if($value == 'm'){
            $sexo = 'Masculino';
        }else{
            $sexo = 'Feminino';
        }

        return $sexo;

    }

    /*public function getHabilidadesAttribute($value){

        $dados = explode(",", $value);

        return $dados;

    }*/

    public function roles(){

        return $this->belongsToMany(Role::class);

    }

    public function hasPermission(Permission $permission){

        return $this->hasAnyRoles($permission->roles);

    }

    public function hasAnyRoles($roles){

        if(is_array($roles) || is_object($roles)){

            return !! $roles->intersect($this->roles)->count();

        }

        return $this->roles->contains('name', $roles);

    }


}
