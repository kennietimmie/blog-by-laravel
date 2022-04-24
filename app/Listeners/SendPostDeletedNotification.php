<?php

namespace App\Listeners;

use App\Events\PostDelete;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
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
        Log::channel('post-delete')->info('Post deleted by user: ' . auth()->user()->username, collect($event->post)->except(['author', 'categories'])->toArray());
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
        //
    }
}
