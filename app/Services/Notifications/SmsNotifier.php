<?php

namespace App\Services\Notifications;

use App\Services\Notifications\Contracts;
use App\Services\Notifications\Traits;

class SmsNotifier extends BaseNotifier
{
    use Traits\LogNotificationsTrait;

    public function notify()
    {
        $this->logNotifyAction();
    }
}
