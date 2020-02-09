<?php

namespace App\Tickets;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'color'
    ];

    /**
     * @var string
     */
    protected $table = 'ticket_status';

    /**
     * The enum types of the Table
     */
    const COLORS = [
        'primary' => 'Primary',
        'secondary' => 'Secondary',
        'success' => 'Success',
        'danger' => 'Danger',
        'warning' => 'Warning',
        'info' => 'Info',
        'light' => 'Light',
        'dark' => 'Dark'
    ];

}
