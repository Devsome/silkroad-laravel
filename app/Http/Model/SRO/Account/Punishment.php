<?php

namespace App\Model\SRO\Account;

use Illuminate\Database\Eloquent\Model;

class Punishment extends Model
{
    /**
     * The Database connection name for the model.
     *
     * @var string
     */
    protected $connection = 'account';

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
    protected $table = 'dbo._Punishment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SerialNo',
        'UserJID',
        'Type',
        'Executor',
        'Shard',
        'CharName',
        'CharInfo',
        'PosInfo',
        'Guide',
        'Description',
        'RaiseTime',
        'BlockStartTime',
        'BlockEndTime',
        'PunishTime',
        'Status'
    ];

    /**
     * Blocking the login from the Char
     */
    const TYPE_BLOCK_LOGIN = 1;

    /**
     * Currently not workling
     */
    const TYPE_BLOCK_P2P_TRADE = 3;

    /**
     * Currently not working
     */
    const TYPE_BLOCK_WHOLE_CHAT = 4;
}
