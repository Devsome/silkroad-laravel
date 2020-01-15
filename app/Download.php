<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'link', 'file_size', 'image_id'
    ];

    /**
     * @return string
     */
    public function image()
    {
        return $this->hasOne('App\Image', 'id', 'image_id');
    }
}
