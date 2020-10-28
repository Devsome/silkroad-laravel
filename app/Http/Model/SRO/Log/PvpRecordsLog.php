<?php

namespace App\Http\Model\SRO\Log;

use App\Http\Model\SRO\Shard\Char;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PvpRecordsLog extends Model
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
    protected $table = 'dbo.pvp_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CharName',
        'CharID',
        'KilledCharName',
        'KilledCharID',
        'type',
        'position',
        'description',
    ];


    /**
     * @return BelongsTo
     */
    public function getKillerCharacter()
    {
        return $this->belongsTo(Char::class, 'CharID', 'CharID')
            ->whereNotNull('CharName16');
    }

    /**
     * @return BelongsTo
     */
    public function getKilledCharacter()
    {
        return $this->belongsTo(Char::class, 'KilledCharID', 'CharID')
            ->whereNotNull('CharName16');
    }
}
