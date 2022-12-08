<?php

namespace App\Services\Notifications\Traits;

use App\Services\Notifications;
use App\Services\Notifications\Contracts;

trait ShouldBeNotified
{
    public function notifyByMail(Contracts\NotificationContract $notification)
    {
        $emailNotifier = new Notifications\EmailNotifier($this, $notification);

        $this->notifyBy($emailNotifier);
    }

    public function notifyBySms(Contracts\NotificationContract $notification)
    {
        $smsNotifier = new Notifications\SmsNotifier($this, $notification);

        $this->notifyBy($smsNotifier);
    }

    public function notifyByPush(Contracts\NotificationContract $notification)
    {
        $pushNotifier = new Notifications\PushNotifier($this, $notification);

        $this->notifyBy($pushNotifier);
    }

    public function notifyBy(Contracts\NotifierContract $notifier)
    {
        $notifier->notify();
    }
}
