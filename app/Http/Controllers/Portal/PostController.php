<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    public function index(){

        $posts = Post::latest('published_at')->published()->with('user')->get();

        return view('portal.post.index', compact('posts'));

    }

    public function show($id){

        $post = Post::find($id)->published()->get();

        return view('portal.post.show', compact('post'));

    }
}
