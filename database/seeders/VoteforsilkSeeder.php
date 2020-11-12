<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoteforsilkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('voteforsilks')->insert([
                [
                    'name' => 'silkroad-servers.com',
                    'pingback' => 'https://silkroad-servers.com/index.php?a=in&u={TUSER}&id={TID}',
                    'reward' => 150,
                    'active' => 1,
                    'waiting_hours' => 12,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],

            ]
        );
    }
}
