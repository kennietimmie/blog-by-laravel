<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\PostCommented;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CommentController extends Controller
{



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Post  $post
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, Request $request)
    {
        $attributes = $request->validate([
            'comment' => ['required', 'min:1', 'max:255']
        ]);

        $comment = $post->comments()->create([
            'content' => $attributes['comment'],
            'user_id' => auth()->id()
        ]);

        $post->author->notify(new PostCommented($post)); // post author
        Notification::send(
            $post->participants->unique()
                ->except(
                    auth()->id(),
                    $post->author->id // just incase he/she commented too
                ),
            new PostCommented($post)
        );
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
