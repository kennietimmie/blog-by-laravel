<?php

namespace App\Listeners;

use App\Events\PostDelete;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class SendPostDeletedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PostDelete  $event
     * @return \App\Models\Post
     */
    public function handle(PostDelete $event)
    {
        Log::channel('post-delete-info')->info('Post deleted by user: ' . auth()->user()->username, collect($event->post)->except(['author', 'categories'])->toArray());
    }

    /**
     * Handle a job failure.
     *
     * @param  \App\Events\PostDelete  $event
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(PostDelete $event, $exception)
    {
        $string = 'The error took place between :start and :end';
        $replaced = preg_replace_array('/:[a-z_]+/', [now()->toTimeString(), now()->toTimeString()], $string);

        Log::channel('post-delete-error')->error('An error ocurred while user: '
        . auth()->user()->username . 'was deleting post: '. $event->post->title . '('. $event->post->id . ')'
        . $replaced, Arr::except($event->post->toArray(), ['author', 'categories']), collect($exception));
    }
}
