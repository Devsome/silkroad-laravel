<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemMallItemCategories extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'item_mall_item_categories';

    /**
     * @var string[]
     */
    protected $fillable = [
        'TypeID2',
        'TypeID3',
        'category',
        'TypeID4',
        'type',
        'race',
    ];

    /**
     * @return HasMany
     */
    public function items(){
        return $this->hasMany(ItemWebMall::Class, 'id', 'category_id');
    }
}
