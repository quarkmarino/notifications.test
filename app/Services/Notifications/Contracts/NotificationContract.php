<?php

namespace App\Services\Notifications\Contracts;

/**
 * Notificacion classes, must implement this contract in order to be used to notify notifiable entities
 */
interface NotificationContract
{
    /**
     * Notification classes must provide a value to identify themselves among any other notifications
     *
     * @return mixed An unique identification value for the Notification entity, usually the Model Id
     */
    public function getNotificationId();

    /**
     * Notification classes must provide a way of retriving a message that the notificaton will carry
     *
     * @return string The Notification message.
     */
    public function getNotificationMesssage(): string;
}
