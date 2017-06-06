<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class PermissaoUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //$user = auth()->user();

        //if($user->tipo === 'Cliente'){
        //    return redirect('/campus');
        //}


        if(Gate::denies('view_quemsomos')) {
            return redirect('/painel');
        }

        return $next($request);

    }
}