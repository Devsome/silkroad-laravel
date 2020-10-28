<?php

namespace App\Http\Model\SRO\Shard;

use Illuminate\Database\Eloquent\Model;

class CharTrijob extends Model
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
    protected $table = 'dbo._CharTrijob';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCharacter()
    {
        return $this->belongsTo(Char::class, 'CharID', 'CharID');
    }
}
