<?php

use Illuminate\Database\Seeder;

class ServerGoldSeeder extends Seeder
{
    public function run()
    {
        DB::table('server_gold')->updateOrInsert(
            [
                'id' => 1
            ],
            [
                'gold' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
    }
}
