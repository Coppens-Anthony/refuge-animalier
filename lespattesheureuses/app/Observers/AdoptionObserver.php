<?php

namespace App\Observers;

use App\Events\AdoptionCreatedEvent;
use App\Models\Adoption;

class AdoptionObserver
{
    /**
     * Handle the Adoption "created" event.
     */
    public function created(Adoption $adoption): void
    {
        event(new AdoptionCreatedEvent($adoption));
    }

    /**
     * Handle the Adoption "updated" event.
     */
    public function updated(Adoption $adoption): void
    {
        //
    }

    /**
     * Handle the Adoption "deleted" event.
     */
    public function deleted(Adoption $adoption): void
    {
        //
    }

    /**
     * Handle the Adoption "restored" event.
     */
    public function restored(Adoption $adoption): void
    {
        //
    }

    /**
     * Handle the Adoption "force deleted" event.
     */
    public function forceDeleted(Adoption $adoption): void
    {
        //
    }
}
