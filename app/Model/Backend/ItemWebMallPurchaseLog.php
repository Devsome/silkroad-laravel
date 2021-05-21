<?php

namespace App\Model\Backend;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemWebMallPurchaseLog extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'item_web_mall_purchase_logs';

    /**
     * @var string[]
     */
    protected $fillable = [
        'item_id',
        'user_id',
        'quantity',
        'plus',
        'total_paid',
    ];

    /**
     * @return BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(ItemWebMall::Class, 'item_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::Class, 'user_id', 'id');
    }
}
