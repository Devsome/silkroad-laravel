<?php

namespace App\Model\SRO\Shard;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
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
    protected $table = 'dbo._Items';

    /**
     * The table primary Key
     *
     * @var string
     */
    protected $primaryKey = 'ID64';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ID64'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getBindingOptionWithItem()
    {
        return $this->belongsTo(BindingOptionWithItem::class,'ID64', 'nItemDBID')
            ->where('nOptValue', '>', 0);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getRefObjCommon()
    {
        return $this->hasOne(RefObjCommon::class, 'ID', 'RefItemID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getRefObjCommonCanTrade()
    {
        return $this->hasOne(RefObjCommon::class, 'ID', 'RefItemID')
            ->select('ID','CanTrade');
    }
}
