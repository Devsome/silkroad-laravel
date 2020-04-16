<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backlinks extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'url', 'image_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
