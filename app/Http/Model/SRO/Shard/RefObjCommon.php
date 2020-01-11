<?php

namespace App\Model\SRO\Shard;

use Illuminate\Database\Eloquent\Model;

class RefObjCommon extends Model
{
    /**
     * The Database connection name for the model.
     *
     * @var string
     */
    protected $connection = 'shard';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dbo._RefObjCommon';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        ''
    ];
}
