<?php

namespace App\Services\Notifications;

use App\Services\Notifications\Contracts;
use Illuminate\Support\Facades\Log;

abstract class BaseNotifier implements Contracts\NotifierContract
{
    protected $notificacion;
    protected $notifiable;

    public function __construct(
        Contracts\NotifiableContract $notifiable,
        Contracts\NotificationContract $notificacion
    )
    {
        $this->notificacion = $notificacion;
        $this->notifiable = $notifiable;
    }
}
