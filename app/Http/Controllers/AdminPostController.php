<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Post;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->slug = Str::slug($request->slug);
        $attributes = array_merge($this->validatePost(), [
            'thumbnail' => $request->has('thumbnail') ? $request->file('thumbnail')->store('thumbnails') : null,
        ]);

        request()->user()->posts()->create($attributes);
        return back()->with('message', 'Post created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->slug = Str::slug($request->slug);
        $attributes = array_merge($this->validatePost($post), [
            'thumbnail' => $request->has('thumbnail') ? $request->file('thumbnail')->store('thumbnails') : null,
        ]);

        $post->update($attributes);
        return back()->with('message', 'Post updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('message', 'Post deleted successfully');
    }

    protected function validatePost(?Post $post = null){
        $post ??= new Post();
        return request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'slug' => ['required', 'min:3', 'max:255', $post->exists ? 'unique:posts,slug,'.$post->id : 'unique:posts'],
            'content' => ['required', 'min:3'],
            'excerpt' => ['required', 'min:3'],
            'categories' => ['array', 'exists:categories,id'],
            'thumbnail' => ['image', 'nullable',]
        ]);

    }
}
