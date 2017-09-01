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

    public function view_artigo(User $user, Artigo $artigo){

        return $user->id == $artigo->user_id;

    }

    public function create_artigo(User $user, Artigo $artigo){

        return $user->id == $artigo->user_id;

    }

    public function edit_artigo(User $user, Artigo $artigo){

        return $user->id == $artigo->user_id;

    }

    public function update_artigo(User $user, Artigo $artigo){

        return $user->id == $artigo->user_id;

    }

    public function delete_artigo(User $user, Artigo $artigo){

        return $user->id == $artigo->user_id;

    }

    public function restore_artigo(User $user, Artigo $artigo){

        return $user->id == $artigo->user_id;

    }

    public function detail_artigo(User $user, Artigo $artigo){

        return $user->id == $artigo->user_id;

    }
}
