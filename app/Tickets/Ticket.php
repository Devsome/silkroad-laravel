<?php

namespace App\Tickets;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_assigned_id', 'ticket_categories', 'title', 'ticket_prioritys_id', 'body', 'ticket_status_id'
    ];
}
