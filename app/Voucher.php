<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'amount',
        'data',
        'expires_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at'
    ];

    protected $casts = [
        'data' => 'collection'
    ];

    /**
     * Get the users who redeemed this voucher.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(config('vouchers.user_model'), 'user_voucher')
            ->withPivot('redeemed_at');
    }

    /**
     * Check if code is expired.
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->expires_at ? Carbon::now()->gte($this->expires_at) : false;
    }

    /**
     * Check if code is redeemed.
     *
     * @return bool
     */
    public function isRedeemed(): bool
    {
        return $this->redeemed_at ? true : false;
    }
}
