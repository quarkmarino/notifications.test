<?php

namespace App\Services\Notifications;

use App\Services\Notifications\Contracts;
use App\Services\Notifications\Traits;

class PushNotifier extends BaseNotifier
{
    use Traits\LogNotificationsTrait;

    public function notify()
    {
        $this->logNotifyAction();
    }
}
