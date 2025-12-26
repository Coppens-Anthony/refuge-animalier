<?php

namespace App\Providers;

use App\Models\Adoption;
use App\Models\User;
use App\Observers\AdoptionObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Adoption::observe(AdoptionObserver::class);
    }
}
