<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionsHouseLog extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'price_sold', 'seller_user_id', 'buyer_user_id', 'state'
    ];

    const STATE_SOLD = 'sold';

    const STATE_NOT_SOLD = 'notsold';
}
