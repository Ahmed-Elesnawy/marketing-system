<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MoneyRequestConfirmedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    protected $markter;

    protected $moneyNeeded;



    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $markter,$moneyNeeded)
    {
        $this->markter = $markter;

        $this->moneyNeeded = $moneyNeeded;
    }

}
