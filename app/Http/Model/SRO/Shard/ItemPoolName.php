<?php

namespace App\Http\Model\SRO\Shard;

use Illuminate\Database\Eloquent\Model;

class ItemPoolName extends Model
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
    protected $table = 'dbo._ItemPoolName';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CodeName',
        'RealName'
    ];
}
