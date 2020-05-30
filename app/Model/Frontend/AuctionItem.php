<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;

class AuctionItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'char_inventory', 'until', 'price', 'price_instead'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getItemInformation()
    {
        return $this->belongsTo(CharInventory::class,'char_inventory', 'id');
    }
}
