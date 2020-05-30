<?php

namespace App\Model\Frontend;

use App\Model\SRO\Shard\Items;
use Illuminate\Database\Eloquent\Model;

class CharInventory extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'from_charid', 'serial64', 'item_id64', 'name', 'imgpath', 'optlevel', 'amount', 'special', 'sort',
        'degree', 'level', 'npc_price', 'race', 'sex', 'data'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getItems()
    {
        return $this->belongsTo(Items::class, 'item_id64', 'ID64');
    }
}
