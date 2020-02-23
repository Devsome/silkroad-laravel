<?php

namespace App\Providers;

use App\Tickets\Ticket;
use App\Tickets\TicketStatus;
use Illuminate\Support\ServiceProvider;

class TicketNewCountProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'backend.layouts.navbar',
            function ($view) {
                $ticket = Ticket::where('ticket_status_id', TicketStatus::STATUS_NEW);
                $data = [
                    'count' => $ticket->count(),
                    'ticket' => $ticket->orderBy('created_at', 'DESC')->take(3)->get(),
                ];
                $view->with('ticketNewProvider', $data);
            }
        );
    }
}
