<?php

namespace App\Services\Notifications\Traits;

use Illuminate\Support\Facades\Log;

trait LogNotificationsTrait
{
    public function logNotifyAction()
    {
        $notificationType = Static::class;

        $messageLog = __('notifications.log_message', [
            'notifiable' => get_class($this->notifiable),
            'notification' => get_class($this->notificacion),
            'notification_type' => $notificationType
        ]);

        Log::channel('db')
            ->info($messageLog, [
                'log_type' => 'notification',
                'notification_type' => $notificationType,
                get_class($this->notifiable) => $this->notifiable->getNotifiableId(),
                get_class($this->notificacion) => $this->notificacion->getNotificationId()
            ]);
    }
}
