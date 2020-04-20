<?php

use Illuminate\Database\Seeder;

class ItemPoolName extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('shard')->unprepared(
            file_get_contents('database/seeds/_ItemPoolName.sql')
        );
    }
}
