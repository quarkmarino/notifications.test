<?php

use App\Enums\CategoryEnum;

return [
    'labels' => collect(CategoryEnum::cases())->mapWithKeys(fn ($category) => [$category->name => $category->label()] ),
];
