<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonationMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('donation_methods')->updateOrInsert(
            [
                'method' => 'paypal'
            ],
            [
                'name' => 'PayPal',
                'image' => 'paypal.png',
                'currency' => 'USD',
                'active' => 0,
                'created_at' => \Carbon\Carbon::now(),
            ]);
    }
}
