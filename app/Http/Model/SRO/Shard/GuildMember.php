<?php

namespace App\Model\SRO\Shard;

use Illuminate\Database\Eloquent\Model;

class GuildMember extends Model
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
    protected $table = 'dbo._GuildMember';

    /**
     * The table primary Key
     *
     * @var string
     */
    protected $primaryKey = 'GuildID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes format for dates.
     *
     * @var array
     */
    protected $dates = [
        'JoinDate'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
