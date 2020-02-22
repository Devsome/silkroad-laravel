<?php

namespace App\Tickets;

use Illuminate\Database\Eloquent\Model;

class TicketPrioritys extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'color'
    ];

    /**
     * The enum types of the Table
     */
    const COLORS = [
        'primary' => 'Primary',
        'success' => 'Success',
        'danger' => 'Danger',
        'warning' => 'Warning',
        'info' => 'Info',
    ];
}
