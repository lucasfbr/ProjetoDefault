<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Artigo;
use App\User;
use App\Permission;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Artigo::class => \App\Policies\ArtigoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);


        $permissions = Permission::with('roles')->get();

        foreach ($permissions as $permission){
            $gate->define($permission->name, function(User $user) use ($permission){
                return $user->hasPermission($permission);
            });
        }


        $gate->before(function (User $user, $ability){

            if($user->hasAnyRoles('adm'))
                return true;
        });



        /*$gate->define('artigo-update', function (User $user, Artigo $artigo){
            print_r($user->id . ' -> ' . $artigo->user_id);exit;
            return $user->id == $artigo->user_id;
        });*/

       /* $permissions = Permission::with('roles')->get();

        foreach ($permissions as $permission){

            $gate->define($permission->name, function (User $user) use ($permission){

                return $user->hasPermission($permission);

            });

        }*/

    }

}
