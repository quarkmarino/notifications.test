<?php

namespace App\Enums;

use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum ChannelEnum: string
{
    use Options, Values;

    case SMS               = 'sms';
    case EMAIL             = 'email';
    case PUSH_NOTIFICATION = 'push_notification';

    public function label(): string
    {
        return match ($this) {
            Self::SMS               => "Sms",
            Self::EMAIL             => "E-mail",
            Self::PUSH_NOTIFICATION => "Push Notification",
        };
    }
}
