<?php

namespace App\Model\SRO\Account;

use App\Model\SRO\Shard\Char;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TbUser extends Model
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
    protected $table = 'dbo.TB_User';

    /**
     * The table primary Key
     *
     * @var string JID
     */
    protected $primaryKey = 'JID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'StrUserID',
        'password',
        'Status',
        'GMrank',
        'Email',
        'reg_ip',
        'sec_primary',
        'sec_content',
        'AccPlayTime',
        'LatestUpdateTime_ToPlayTime'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getSkSilk()
    {
        return $this->belongsTo(SkSilk::class, 'JID', 'JID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function getShardUser()
    {
        return $this->belongsToMany(Char::class, '_User', 'UserJID', 'CharID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getPunishmentUser()
    {
        return $this->hasMany(Punishment::class, 'UserJID', 'JID');
    }

    public function getIsBlockedUser()
    {
        $query = $this->hasMany(BlockedUser::class, 'UserJID', 'JID');
        $query->where('timeEnd', '>', Carbon::now()->format('Y-m-d H:i:s'))->first();
        return $query;
    }
}
