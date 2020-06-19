<?php

use Illuminate\Database\Seeder;
use App\ServerGold;

class ServerGoldSeeder extends Seeder
{
    public function run()
    {
        ServerGold::create(
            [
                'gold' => 0
            ]
        );
    }
}
