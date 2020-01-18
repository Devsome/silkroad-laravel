<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename', 'mime', 'model', 'original_filename'
    ];

    /**
     * @var array
     */
    public static $models = [
        Download::class,
    ];
}
