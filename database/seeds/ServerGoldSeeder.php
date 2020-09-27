<?php

use Illuminate\Database\Seeder;

class ServerGoldSeeder extends Seeder
{
    public function run()
    {
        DB::table('server_gold')->insert([
            [
                'gold' => 0,
            ]
        ]);
    }
}
