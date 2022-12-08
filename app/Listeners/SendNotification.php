<?php

namespace App\Listeners;

use App\Actions\NotifyUsersAction;
use App\Events\MessageCreated;
use App\Models\User;
use App\Services\Notifications\Contracts\NotificationContract;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotification
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
     * @param  \App\Events\MessageCreated  $event
     * @return void
     */
    public function handle(MessageCreated $event)
    {
        NotifyUsersAction::ofMessage($event->message);
    }
}
