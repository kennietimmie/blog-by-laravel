<?php

namespace App\Http\Controllers;

use App\Events\ActivityEvent;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category']))->paginate(12)->withQueryString()
        ]);
    }

    public function show(Post $post){
        event(new ActivityEvent('posts.view', auth()->user(), $post));
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
