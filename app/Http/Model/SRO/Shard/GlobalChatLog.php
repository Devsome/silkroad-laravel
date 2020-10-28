<?php

namespace App\Http\Model\SRO\Shard;

use Illuminate\Database\Eloquent\Model;

class GlobalChatLog extends Model
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
    protected $table = 'dbo._GlobalChat';

    /**
     * The table primary Key
     *
     * @var string JID
     */
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CharName',
        'Message',
        'Time'
    ];

    /**
     * The attributes format for dates.
     *
     * @var array
     */
    protected $dates = [
        'Time'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function getTbUser()
    {
        return $this->belongsTo(TbUser::class, 'CharName', 'StrUserID');
    }
}
