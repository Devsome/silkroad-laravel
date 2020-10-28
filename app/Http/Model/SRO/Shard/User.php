<?php

namespace App\Http\Model\SRO\Shard;

use App\Http\Model\SRO\Account\SkSilk;
use App\Http\Model\SRO\Account\TbUser;
use Illuminate\Database\Eloquent\Model;

class User extends Model
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
    protected $table = 'dbo._User';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'UserJID', 'CharID'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getTbUser()
    {
        return $this->belongsTo(TbUser::class, 'UserJID', 'JID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getSkSilk()
    {
        return $this->belongsTo(SkSilk::class, 'UserJID', 'JID');
    }
}
