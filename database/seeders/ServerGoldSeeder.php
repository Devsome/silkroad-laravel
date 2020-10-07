<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
