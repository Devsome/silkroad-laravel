<?php

namespace App\Http\Model\SRO\Shard;

use App\Model\SRO\Shard\Guild;
use Illuminate\Database\Eloquent\Model;

class SiegeFortress extends Model
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
    protected $table = 'dbo._SiegeFortress';

    /**
     * The table primary Key
     *
     * @var string
     */
    protected $primaryKey = 'FortressID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes format for dates.
     *
     * @var array
     */
    protected $dates = [
        'CreatedDungeonTime'
    ];

    /**
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getGuildName()
    {
        $query = $this->hasOne(Guild::class, 'ID', 'GuildID');
        $query->where('ID', '!=', 0);
        return $query;
    }
}
