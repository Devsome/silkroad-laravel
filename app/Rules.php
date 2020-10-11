<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['body'];
}
