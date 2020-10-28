<?php

namespace App\Http\Model\SRO\Log;

use App\Http\Model\SRO\Shard\Char;
use Illuminate\Database\Eloquent\Model;

class OnlineOfflineLog extends Model
{

    /**
     * The Database connection name for the model.
     *
     * @var string
     */
    protected $connection = 'log';

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
    protected $table = 'dbo.onlineofflinelog';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CharId',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'integer',
    ];

    /**
     * If the Char is logged in
     */
    const STATUS_LOGGED_IN = 4;

    /**
     * If the Char is logged out
     */
    const STATUS_LOGGED_OUT = 6;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCharacter() {
        return $this->belongsTo(Char::class, 'CharID', 'CharID')
            ->whereNotNull('CharName16')
            ->select(['CharID', 'CharName16', 'CurLevel', 'LatestRegion', 'PosX', 'PosY', 'PosZ']);
    }
}
