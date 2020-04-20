<?php

namespace App\Http\Model\SRO\Shard;

use Illuminate\Database\Eloquent\Model;

class CharCos extends Model
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
    protected $table = 'dbo._CharCos';

    /**
     * The table primary Key
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'OwnerCharID',
        'RefCharID',
        'HP',
        'MP',
        'KeeperNPC',
        'State',
        'CharName',
        'Lvl',
        'ExpOffset',
        'HGP',
        'PetOption',
        'RentEndTime'
    ];
}
