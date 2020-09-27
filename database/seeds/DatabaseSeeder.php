<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(TicketStatusSeeder::class);
        $this->call(ItemPoolName::class);
        $this->call(MagOptSeeder::class);
        $this->call(ServerGoldSeeder::class);
        $this->call(DonationMethodsSeeder::class);
    }
}
