<?php

use App\Tickets\TicketStatus;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('ticket_status')->insert([
            [
                'name' => 'new',
                'color' => 'primary',
                'status_id' => TicketStatus::STATUS_NEW,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'pending',
                'color' => 'info',
                'status_id' => TicketStatus::STATUS_PENDING,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'closed',
                'color' => 'success',
                'status_id' => TicketStatus::STATUS_CLOSED,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'reopen',
                'color' => 'primary',
                'status_id' => TicketStatus::STATUS_REOPEN,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'final close',
                'color' => 'danger',
                'status_id' => TicketStatus::STATUS_FINAL_CLOSE,
                'created_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
