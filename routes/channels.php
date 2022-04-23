<?php

use App\Models\Post;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('pri-activities.{post}', function($user, Post $post) {
return $user->id === $post->user_id || true;
});

Broadcast::channel('pre-activities.{post}', function($user,Post $post){
    return request()->user()->can('admin') ? [
        'user' => $user,
    ] : null;
});