<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersCreatedCounts extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'count', 'cached_at'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
