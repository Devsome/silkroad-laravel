<?php

namespace App\Model\Backend;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemWebMallAdminLog extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'item_web_mall_admin_logs';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'data',
        'type',
    ];

    protected $casts = [
        'data' => 'json'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::Class, 'user_id', 'id');
    }
}
