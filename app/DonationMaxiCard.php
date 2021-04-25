<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationMaxiCard extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'maxi_card_epin';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'silk'
    ];
}
