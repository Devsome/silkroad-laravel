<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerInformation extends Model
{
    protected $fillable = [
        'title', 'body', 'order'
    ];
}
