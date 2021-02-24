<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class EventForRegister
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $Name;
    public $OtpCode;
    public $ExpTime; 
    public $GetEmail; 


    public function __construct( $Name, $OtpCode, $ExpTime, $GetEmail)
    {
        //
        $this->name=$Name;
        $this->OtpCode=$OtpCode;
        $this->ExpTime=$ExpTime;
        $this->GetEmail=$GetEmail;

        

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');

    }
}
