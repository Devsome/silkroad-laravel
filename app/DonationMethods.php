<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationMethods extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'model', 'active'
    ];
}
