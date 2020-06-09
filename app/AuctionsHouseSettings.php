<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionsHouseSettings extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'settings'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'settings' => 'array',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
