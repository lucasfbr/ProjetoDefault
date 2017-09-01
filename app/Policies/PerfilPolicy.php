<?php

namespace App\Policies;

use App\User;
use App\Perfil;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerfilPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function view_perfil(User $user, Perfil $perfil){

        return $user->id == $perfil->user_id;

    }

    public function update_perfil(User $user, Perfil $perfil){

        return $user->id == $perfil->user_id;

    }


}
