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
                'color' => 'secondary',
                'status_id' => TicketStatus::STATUS_PENDING,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'declined',
                'color' => 'danger',
                'status_id' => TicketStatus::STATUS_DECLINED,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'closed',
                'color' => 'success',
                'status_id' => TicketStatus::STATUS_CLOSED,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'closed by user',
                'color' => 'light',
                'status_id' => TicketStatus::STATUS_CLOSED_BY_USER,
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'closed by admin',
                'color' => 'success',
                'status_id' => TicketStatus::STATUS_CLOSED_BY_ADMIN,
                'created_at' => \Carbon\Carbon::now(),
            ]
        ]);
    }
}
