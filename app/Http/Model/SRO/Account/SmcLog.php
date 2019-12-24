<?php

namespace App\Model\SRO\Account;

use Illuminate\Database\Eloquent\Model;

class SmcLog extends Model
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
    protected $table = 'dbo._SMCLog';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'szUserID',
        'Catagory',
        'szLog',
        'dLogDate'
    ];
}
