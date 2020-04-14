<?php

namespace App\Events;

use App\Player;
use App\Session;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlayerJoined implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public Player $player;
    public Session $session;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Session $session, Player $player)
    {
        $this->player = $player;
        $this->session = $session;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->session->id);
    }

    public function broadcastAs()
    {
        return 'player-joined';
    }
}
