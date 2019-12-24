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
     * The primary Key for the table
     *
     * @var string SerialNo
     */
    protected $primaryKey = 'SerialNo';

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
}
