<?php

namespace App\Services\Notifications\Contracts;

use App\Services\Notifications\Contracts\NotificationContract;
use App\Services\Notifications\Contracts\NotifiableContract;


/**
 * All notifiers, must implement this constract to conform the propper notify action.
 */
interface NotifierContract
{
    /**
     * Notifier must define a way to Notify the Notifiable Entity with a Notification
     */
    public function notify();
}
