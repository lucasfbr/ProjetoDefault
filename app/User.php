<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Permission;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ddd', 'fone', 'celular', 'estado', 'cidade', 'bairro', 'endereco', 'numero', 'profissao', 'empresa', 'sexo', 'foto', 'educacao', 'habilidades', 'notas',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getFotoAttribute($value){

        $fotoUsuario = '';

        if($value){
            $fotoUsuario = $value;
        }else{
            $fotoUsuario = '/assets/painel/images/homem.jpg';
        }

        return $fotoUsuario;

    }

    public function setPasswordAttribute($value){

        if($value){
            $this->attributes['password'] = bcrypt($value);
        }



    }


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
