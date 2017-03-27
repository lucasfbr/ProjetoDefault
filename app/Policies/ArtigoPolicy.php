<?php

namespace App\Policies;

use App\User;
use App\Artigo;
use Illuminate\Auth\Access\HandlesAuthorization;


class ArtigoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function artigoUpdate(User $user, Artigo $artigo){

        return $user->id == $artigo->user_id;

    }
}
