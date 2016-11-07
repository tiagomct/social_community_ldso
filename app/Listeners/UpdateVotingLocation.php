<?php

namespace App\Listeners;

use App\Events\UserUpdatedVotingLocation;
use App\VotingLocation;
use GuzzleHttp\Client;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateVotingLocation
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
     * @param  UserUpdatedVotingLocation $event
     * @return void
     */
    public function handle(UserUpdatedVotingLocation $event)
    {
        VotingLocation::fromUser($event->user);
    }
}
