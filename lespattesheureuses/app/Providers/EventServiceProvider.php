<?php

namespace App\Providers;

use App\Events\MemberCreatedEvent;
use App\Listeners\SendMemberAccountMailListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        MemberCreatedEvent::class => [
            SendMemberAccountMailListener::class
        ]
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
