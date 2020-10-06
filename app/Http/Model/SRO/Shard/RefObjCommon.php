<?php

namespace App\Model\SRO\Shard;

use Illuminate\Database\Eloquent\Model;

class RefObjCommon extends Model
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
    protected $table = 'dbo._RefObjCommon';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        ''
    ];

    /**
     * @var array
     */
    protected $casts = [
        'CashItem' => 'integer',
        'Bionic' => 'integer',
        'TypeID1' => 'integer',
        'TypeID2' => 'integer',
        'TypeID3' => 'integer',
        'TypeID4' => 'integer',
        'DecayTime' => 'integer',
        'Country' => 'integer',
        'Rarity' => 'integer',
        'CanTrade' => 'integer',
        'CanSell' => 'integer',
        'CanBuy' => 'integer',
        'CanBorrow' => 'integer',
        'CanDrop' => 'integer',
        'CanPick' => 'integer',
        'CanRepair' => 'integer',
        'CanUse' => 'integer',
        'CanThrow' => 'integer',
        'Price' => 'integer',
        'CostRepair' => 'integer',
        'CostRevive' => 'integer',
        'CostBorrow' => 'integer',
        'KeepingFee' => 'integer',
        'SellPrice' => 'integer',
        'ReqLevelType1' => 'integer',
        'ReqLevel1' => 'integer',
        'ReqLevelType2' => 'integer',
        'ReqLevel2' => 'integer',
        'ReqLevelType3' => 'integer',
        'ReqLevel3' => 'integer',
        'ReqLevelType4' => 'integer',
        'ReqLevel4' => 'integer',
        'MaxContain' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getRefObjItem()
    {
        return $this->hasOne(RefObjItem::class, 'ID', 'Link');
    }
}
