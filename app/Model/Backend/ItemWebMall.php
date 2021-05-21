<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemWebMall extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'item_web_mall';
    /**
     * @var string[]
     */
    protected $fillable = [
        'item_id',
        'item_name',
        'CodeName128',
        'gender',
        'category_id',
        'silk_price',
        'item_quantity',
        'item_plus',
        'tooltip',
    ];

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ItemMallItemCategories::Class, 'category_id', 'id');
    }
}
