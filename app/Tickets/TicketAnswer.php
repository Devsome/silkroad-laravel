<?php

namespace App\Tickets;

use App\User;
use Illuminate\Database\Eloquent\Model;

class TicketAnswer extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'ticket_id', 'user_id', 'body'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversation()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUserName()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
