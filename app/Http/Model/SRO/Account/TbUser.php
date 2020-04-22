<?php

namespace App\Model\SRO\Account;

use App\Model\SRO\Shard\Char;
use App\Model\SRO\Shard\Chest;
use App\Model\SRO\Shard\Items;
use App\User;
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
        'Name',
        'password',
        'Status',
        'GMrank',
        'Email',
        'regtime',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getSkSilkHistory()
    {
        return $this->hasMany(SkSilkBuyList::class, 'UserJID', 'JID');
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
        $query = $this->hasMany(Punishment::class, 'UserJID', 'JID');
        $query->where('BlockEndTime', '>', Carbon::now()->format('Y-m-d H:i:s'));
        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getIsBlockedUser()
    {
        $query = $this->hasMany(BlockedUser::class, 'UserJID', 'JID');
        $query->where('timeEnd', '>', Carbon::now()->format('Y-m-d H:i:s'))->first();
        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getChestUser()
    {
        $query = $this->hasMany(Chest::class, 'UserJID', 'JID');
        $query->where('ItemID','!=', 0);
        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getChestItemUser()
    {
        $query = $this->belongsToMany(Items::class, Chest::class, 'UserJID', 'ItemID', '', 'ID64');
        $query->where('ItemID', '!=', 0);
        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getWebUser()
    {
        return $this->hasOne(User::class, 'jid', 'JID');
    }
}
