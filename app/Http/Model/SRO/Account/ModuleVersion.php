<?php

namespace App\Http\Model\SRO\Account;

use Illuminate\Database\Eloquent\Model;

class ModuleVersion extends Model
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
    protected $table = 'dbo._ModuleVersion';

    /**
     * The primary Key for the table
     *
     * @var string SerialNo
     */
    protected $primaryKey = 'nID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nDivisionID',
        'nContentID',
        'nModuleID',
        'nVersion',
        'szVersion',
        'szDesc',
        'nValid'
    ];
}
