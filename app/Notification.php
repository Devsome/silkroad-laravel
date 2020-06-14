<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Notification extends Model
{
    use Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'key', 'channel', 'url', 'discord_channel'
    ];

    public function routeNotificationForDiscord()
    {
        return $this->discord_channel;
    }
}
