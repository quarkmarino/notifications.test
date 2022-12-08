<?php

namespace App\Models;

use App\Enums\CategoryEnum;
use App\Events\MessageCreated;
use App\Services\Notifications\Contracts\NotificationContract;
use Illuminate\Database\Eloquent\Model;

class Message extends Model implements NotificationContract
{
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => MessageCreated::class,
    ];

    protected $fillable = [
        'content',
        'category',
    ];

    protected $casts = [
        'category' => CategoryEnum::class,
    ];

    # Notification

    public function getNotificationId()
    {
        return json_encode($this->only('id', 'category'));
    }

    public function getNotificationMesssage(): string
    {
        return $this->content;
    }
}
