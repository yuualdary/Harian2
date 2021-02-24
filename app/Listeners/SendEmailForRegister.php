<?php

namespace App\Listeners;

use App\Events\EventForRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
class SendEmailForRegister
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EventForRegister  $event
     * @return void
     */
    public function handle(EventForRegister $event)
    {
        //
        Mail::to($event->GetEmail)->send(new RegisterMail($event->Name,$event->OtpCode,$event->ExpTime));



    }
}
