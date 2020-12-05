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
                    'pingback' => 'https://silkroad-servers.com/index.php?a=in&u={SID}&id={JID}',
                    'ip' => '116.203.217.217',
                    'reward' => 50,
                    'active' => 0,
                    'waiting_hours' => 12,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'name' => 'xtremetop100.com',
                    'pingback' => 'http://www.xtremetop100.com/in.php?site={SID}&postback={JID}',
                    'ip' => '199.59.161.214',
                    'reward' => 50,
                    'active' => 0,
                    'waiting_hours' => 12,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]
            ]
        );
    }
}
