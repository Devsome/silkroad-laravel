<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaxiCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maxi_card_epin')->updateOrInsert(
            [
                'id' => 1
            ],
            [
                'epin_amount' => 1,
                'silk_amount' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::table('maxi_card_epin')->updateOrInsert(
            [
                'id' => 2
            ],
            [
                'epin_amount' => 10,
                'silk_amount' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::table('maxi_card_epin')->updateOrInsert(
            [
                'id' => 3
            ],
            [
                'epin_amount' => 25,
                'silk_amount' => 25,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::table('maxi_card_epin')->updateOrInsert(
            [
                'id' => 4
            ],
            [
                'epin_amount' => 50,
                'silk_amount' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::table('maxi_card_epin')->updateOrInsert(
            [
                'id' => 5
            ],
            [
                'epin_amount' => 75,
                'silk_amount' => 75,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::table('maxi_card_epin')->updateOrInsert(
            [
                'id' => 6
            ],
            [
                'epin_amount' => 100,
                'silk_amount' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::table('maxi_card_epin')->updateOrInsert(
            [
                'id' => 7
            ],
            [
                'epin_amount' => 250,
                'silk_amount' => 250,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::table('maxi_card_epin')->updateOrInsert(
            [
                'id' => 8
            ],
            [
                'epin_amount' => 500,
                'silk_amount' => 500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        DB::table('maxi_card_epin')->updateOrInsert(
            [
                'id' => 9
            ],
            [
                'epin_amount' => 100,
                'silk_amount' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }
}
