<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'key', 'channel', 'url', 'discord_channel'
    ];

}
