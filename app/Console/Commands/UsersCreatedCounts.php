<?php

namespace App\Console\Commands;

use App\Model\SRO\Account\TbUser;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UsersCreatedCounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:created-counts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userCount = TbUser::whereDate('regtime', Carbon::now()->subDay())->count();
        \App\UsersCreatedCounts::create(['count' => $userCount, 'cached_at' => Carbon::now()]);

        $this->info('users:created-counts command run successfully!');

        return true;
    }
}
