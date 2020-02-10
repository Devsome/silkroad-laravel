<?php

namespace App\Tickets;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_assigned_id', 'ticket_categories_id', 'title', 'ticket_prioritys_id', 'body', 'ticket_status_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUserName()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCategoryName()
    {
        return $this->belongsTo(TicketCategories::class, 'ticket_categories_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPriorityName()
    {
        return $this->belongsTo(TicketPrioritys::class, 'ticket_prioritys_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getStatusName()
    {
        return $this->belongsTo(TicketStatus::class, 'ticket_status_id', 'id');
    }
}
