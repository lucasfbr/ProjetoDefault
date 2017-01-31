<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $posts = $post->all();

        return view('painel.home.index', ['posts' => $posts]);
    }

    public function update($id){

        $post = Post::find($id);

        //neste código estamos utilizando o service provider criado no arquivo AuthServiceProvider
        //ao cria-lo nos demos o nome de 'update-post' e necessita de um post para a verificação
        $this->authorize('update-post', $post);

        return view('update-post', ['post' => $post]);

    }

    public function rolesPermissions(){

        $user = auth()->user()->name;

        echo "<h1>$user</h1>";

        foreach (auth()->user()->roles as $role){

            echo "$role->name -> ";

            $permissions = $role->permissions;
            foreach ($permissions as $permission){

                echo "$permission->name ,";

            }

            echo "<hr>";
        }
    }


}
