<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVoucher extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'voucher_id',
        'redeemed_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'redeemed_at'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getVoucher()
    {
        return $this->hasOne(Voucher::class, 'id', 'voucher_id');
    }
}
