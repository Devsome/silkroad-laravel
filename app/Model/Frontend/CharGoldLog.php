<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;

class CharGoldLog extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'from_charid', 'deposit', 'withdraw'
    ];
}
