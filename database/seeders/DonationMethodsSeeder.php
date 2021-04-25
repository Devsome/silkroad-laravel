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

        DB::table('donation_methods')->updateOrInsert(
            [
                'method' => 'stripe'
            ],
            [
                'name' => 'Stripe',
                'image' => 'stripe.png',
                'currency' => 'USD',
                'active' => 0,
                'created_at' => \Carbon\Carbon::now(),
            ]);

        DB::table('donation_methods')->updateOrInsert(
            [
                'method' => 'maxicard'
            ],
            [
                'name' => 'MaxiCard',
                'image' => 'maxicard.png',
                'currency' => 'TL',
                'active' => 0,
                'created_at' => \Carbon\Carbon::now(),
            ]);
    }
}
