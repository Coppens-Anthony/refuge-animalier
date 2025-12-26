<?php

namespace App\Listeners;

use App\Events\MemberCreatedEvent;
use App\Mail\MemberCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMemberAccountMailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        Mail::to($event->user->email)->queue(new MemberCreatedMail($event->user));
    }
}
