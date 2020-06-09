<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    public $fillable = [
        'title', 'slug', 'body', 'images_id', 'published_at'
    ];

    /**
     * @var array
     */
    protected static $logAttributes = [
        'title', 'slug', 'body'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime'
    ];

    /**
     * @var array
     */
    protected static $ignoreChangedAttributes = ['published_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(NewsComment::class);
    }

}
