<?php

namespace App\Model\SRO\Account;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
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
    protected $table = 'dbo._Notice';

    /**
     * The primary Key for the table
     *
     * @var string SerialNo
     */
    protected $primaryKey = 'ID';

    /**
     * The attributes format for dates.
     *
     * @var array
     */
    protected $dates = [
        'EditDate'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ContentId',
        'Subject',
        'Article',
        'EditDate'
    ];
}
