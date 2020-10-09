<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HideRankingGuild extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'guild', 'guild_id'
    ];
}
