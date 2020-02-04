<?php

namespace App\Model\SRO\Shard;

use Illuminate\Database\Eloquent\Model;

class Guild extends Model
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
    protected $table = 'dbo._Guild';

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

    ];

    /**
     * The attributes format for dates.
     *
     * @var array
     */
    protected $dates = [
        'FoundationDate'
    ];

    /**
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getGuildMembers()
    {
        return $this->hasMany(GuildMember::class, 'ID', 'GuildID');
    }
}
