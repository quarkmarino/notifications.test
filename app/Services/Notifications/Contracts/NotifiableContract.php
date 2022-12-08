<?php

namespace App\Services\Notifications\Contracts;

/**
 * Indicates to the class that it should behave as a notifiable entity
 */
interface NotifiableContract
{
    /**
     * Notifiable classes must provide a value to identify themselves among any other notifiable
     *
     * @return mixed An unique identification value for the Notifiable entity, usually the Model Id
     */
    public function getNotifiableId();
}
