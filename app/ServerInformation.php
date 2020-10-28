<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerInformation extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'order'
    ];
}
