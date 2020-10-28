<?php

namespace App;

use App\Http\Model\SRO\Account\OnlineOfflineLog;
use Illuminate\Database\Eloquent\Model;

class SupportersOnline extends Model
{
    /**
     * @var string
     */
    protected $table = 'supporters_online';

    /**
     * @var array
     */
    protected $fillable = [
        'charname', 'CharID'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCharOnlineOffline()
    {
        return $this->belongsTo(OnlineOfflineLog::class, 'CharID', 'CharID');
    }
}
