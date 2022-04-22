<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActivityEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $type, $user, $post;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type, $user,?Post $post = null)
    {
        $this->type = $type;
        $this->user = $user;
        $this->post = $post ?? (object) ['id' => null];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return  [new Channel('activities'), new PrivateChannel('pri-activities.'. $this->post->id)];
    }

    /**
     * The model event's broadcast name.
     *
     * @param  string  $event
     * @return string|null
     */
    public function broadcastAs()
    {
        return 'activity-monitor';
    }

    /**
     * The name of the queue on which to place the broadcasting job.
     *
     * @return string
     */
    public function broadcastQueue()
    {
        return 'broadcastable';
    }

    /**
     * Get the data to broadcast for the model.
     *
     * @param  string  $event
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'user' => $this->user ?? null,
            'action'   => ucfirst(strtolower($this->type)),
            'on'       => now()->toDateTimeString(),
            'post' => collect($this->post)->except(['author', 'categories']),
        ];
    }
}
