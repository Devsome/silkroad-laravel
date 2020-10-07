<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MagOptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('shard')->unprepared(
            file_get_contents('database/seeds/_MagOpt.sql')
        );
    }
}
