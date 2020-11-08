<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pages extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @var string[]
     */
    protected $fillable = [
        'type', 'title', 'body'
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
