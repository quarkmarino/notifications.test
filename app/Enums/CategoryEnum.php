<?php

namespace App\Enums;

use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum CategoryEnum: string
{
    use Options, Values, Names;

    case SPORTS  = 'sports';
    case FINANCE = 'finance';
    case MOVIES  = 'movies';

    public function label(): string
    {
        return match ($this) {
            Self::SPORTS  => "Sports",
            Self::FINANCE => "Finance",
            Self::MOVIES  => "Movies",
        };
    }

    public function option(): string
    {
        return match ($this) {
            Self::SPORTS  => 0,
            Self::FINANCE => 1,
            Self::MOVIES  => 2,
        };
    }
}
