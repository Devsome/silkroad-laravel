<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;

class CharGold extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'gold'
    ];
}
