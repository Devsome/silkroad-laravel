<?php

namespace App\Console\Commands;

use App\Model\SRO\Account\TbUser;
use App\User;
use Illuminate\Console\Command;

class ImportSilkroadAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:silkroad-accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing Silkroad Accounts to the Laravel Table';

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
        $tbUser = TbUser::whereNotNull('Email')->where('Email', '!=', '')->get();
        $count = 0;
        foreach($tbUser as $user)
        {
            $this->info('Importing -> ' .$user->StrUserID);
            $existUser = User::where('jid', '=', $user->JID)->get();
            if($existUser->isEmpty()) {
                $createdUser = User::create([
                    'name' => $user->Name ?: $user->StrUserID,
                    'silkroad_id' => $user->StrUserID,
                    'jid' => $user->JID,
                    'email' => $user->Email,
                    'password' => $user->password,
                    'reflink' => \Str::uuid()
                ]);

                if($user->sec_primary === 1 && $user->sec_content === 1) {
                    $createdUser->assignRole('backend');
                }
            }
            $count++;
        }

        $this->info('import:silkroad-accounts command run successfully!');
        $this->info('Imported [' . $count . '] Accounts');
        return true;
    }
}
