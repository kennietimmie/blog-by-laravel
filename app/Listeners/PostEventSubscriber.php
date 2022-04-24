<?php

namespace App\Listeners;

use App\Events\PostDelete;

class PostEventSubscriber
{
  /**
   * Handle post delete events.
   */
  public function handlePostDelete($event)
  {
    //
  }

  /**
   * Handle post update events.
   */
  public function handlePostUpdate($event)
  {
    //
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param  \Illuminate\Events\Dispatcher  $events
   * @return array
   */
  public function subscribe($events)
  {
    return [
      PostDelete::class => 'handlePostDelete',
      // PostUpdate::class => 'handlePostUpdate',
    ];
  }
}
