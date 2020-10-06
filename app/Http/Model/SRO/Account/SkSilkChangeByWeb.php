<?php

namespace App\Model\SRO\Account;

use Illuminate\Database\Eloquent\Model;

class SkSilkChangeByWeb extends Model
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
    protected $table = 'dbo.SK_SilkChange_BY_Web';

    /**
     * The table primary Key
     *
     * @var string JID
     */
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'JID', // int
        'silk_remain', // int
        'silk_offset', // int
        'silk_type', // tinyint
        'reason', // tinyint
    ];

    /**
     * Type 0 is regular Silk
     */
    public const SilkTypeSilk = 0;

    /**
     * Reason 3 is for Web
     */
    public const SilkReasonBuy = 0;

    /**
     * Reason 1 is for Admin
     */
    public const SilkReasonAdmin = 1;

}
