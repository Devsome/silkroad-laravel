<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteforsilkVoted extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'voteforsilk_vote';

    /**
     * @var array
     */
    protected $fillable = [
        'voteforsilks_id', 'user_id', 'voted_at', 'vote_again_at'
    ];

    /**
     * @var array
     */
    public $timestamps = [
        'voted_at', 'vote_again_at'
    ];
}
