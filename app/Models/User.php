<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Casts\ChannelsCast;
use App\Casts\SubscriptionsCast;
use App\Enums\CategoryEnum;
use App\Enums\ChannelEnum;
use App\Services\Notifications\Contracts\NotifiableContract;
use App\Services\Notifications\Traits\ShouldBeNotified;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements NotifiableContract
{
    use HasApiTokens, HasFactory, ShouldBeNotified;

    const ADMIN_ID = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'subscribed' => SubscriptionsCast::class,
        'channels' => ChannelsCast::class,
    ];

    # Relationships

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id');
    }

    # Notification

    public function getNotifiableId()
    {
        return $this->only(['id', 'name', 'email', 'phone_number']);
    }

    # Accessors

    public function getIsAdminAttribute()
    {
        return $this->id == Self::ADMIN_ID;
    }
}
