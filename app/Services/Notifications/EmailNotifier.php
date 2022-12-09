<?php

namespace App\Services\Notifications;

use App\Services\Notifications\Contracts;
use App\Services\Notifications\Traits;

class EmailNotifier extends BaseNotifier
{
    use Traits\LogNotifications;

    public function notify()
    {
        $this->logNotifyAction();
    }
}
