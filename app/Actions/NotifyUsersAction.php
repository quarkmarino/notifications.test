<?php

namespace App\Actions;

use App\Enums\ChannelEnum;
use App\Models\User;
use App\Services\Notifications\Contracts\NotificationContract;

class NotifyUsersAction
{
    public static function OfMessage(NotificationContract $message)
    {
        $users = User::when($message->category)
            ->whereJsonContains('subscribed', $message->category);

            // dump($users->count());

            $users->each(fn ($user) => $user->channels->each(function ($channel) use ($user, $message) {
                match ($channel) {
                    ChannelEnum::EMAIL => $user->notifyByMail($message),
                    ChannelEnum::SMS => $user->notifyBySms($message),
                    ChannelEnum::PUSH_NOTIFICATION => $user->notifyByPush($message),
                    default => null,
                };
            }));
        }
}
