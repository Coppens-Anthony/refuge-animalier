<?php

namespace App\Listeners;

use App\Enums\Members;
use App\Events\MemberCreatedEvent;
use App\Mail\AdoptionCreatedMail;
use App\Mail\MemberCreatedMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendAdoptionMailListener
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
        $admin = User::where('status', Members::ADMINISTRATOR)->first();
        \Log::info('SendAdoptionMailListener triggered. Admin: '.($admin?->email ?? 'none'));

        if ($admin) {
            Mail::to($admin)->send(new AdoptionCreatedMail($event->adoption));
        } else {
            \Log::warning('No admin found to send adoption mail.');
        }
    }

}
