<?php

namespace App\Model\SRO\Shard;

use App\Model\SRO\Account\OnlineOfflineLog;
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getGuildMemberUser()
    {
        return $this->hasOne(GuildMember::class, 'CharID', 'CharID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getGuildUser()
    {
        $query = $this->hasOne(Guild::class, 'ID', 'GuildID');
        $query->where('ID', '!=', 0);
        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getInventoryUser()
    {
        return $this->hasMany(Inventory::class, 'CharID', 'CharID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getInventoryItemUser()
    {
        $query = $this->belongsToMany(Items::class, Inventory::class, 'CharID', 'ItemID', '', 'ID64');
        $query->whereNotBetween('_Inventory.Slot', [0, 12])
            ->where('ItemID', '!=', 0);
        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getEquipmentUser()
    {
        $query = $this->belongsToMany(Items::class, Inventory::class, 'CharID', 'ItemID', '', 'ID64');
        $query->select('*')
            ->whereBetween('_Inventory.Slot', [0, 12])
            ->where('_Items.RefItemID', '!=', 2)
            ->orderBy('_Inventory.Slot', 'ASC');
        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getAvatarInventoryUser()
    {
        return $this->hasMany(InventoryForAvatar::class, 'CharID', 'CharID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getAvatarInventoryItemUser()
    {
        $query = $this->belongsToMany(Items::class, InventoryForAvatar::class, 'CharID', 'ItemID', '', 'ID64');
        $query->where('ItemID', '!=', 0);
        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCharOnlineOffline()
    {
        return $this->belongsTo(OnlineOfflineLog::class, 'CharID', 'CharID');
    }

    /**
     * Getting values when Char is logged in
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCharOnlineOfflineLoggedIn()
    {
        $q = $this->belongsTo(OnlineOfflineLog::class, 'CharID', 'CharID');
        $q->where('status', OnlineOfflineLog::STATUS_LOGGED_IN);
        return $q;
    }
}
