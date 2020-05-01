<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;

class CharInventoryLog extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'from_charid', 'state', 'serial64', 'item_id64'
    ];
}
