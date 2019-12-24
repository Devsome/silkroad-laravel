<?php

namespace App\Model\SRO\Shard;

use Illuminate\Database\Eloquent\Model;

class Char extends Model
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
    protected $table = 'dbo._Char';

    /**
     * The table primary Key
     *
     * @var string
     */
    protected $primaryKey = 'CharID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CharID',
        'Deleted',
        'RefObjID',
        'CharName16',
        'NickName16',
        'LastLogout'
    ];

    /**
     * The attributes format for dates.
     *
     * @var array
     */
    protected $dates = [
        'LastLogout'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
