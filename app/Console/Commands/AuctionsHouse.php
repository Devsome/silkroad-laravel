<?php

namespace App\Console\Commands;

use App\AuctionsHouseLog;
use App\AuctionsHouseSettings;
use App\Model\Frontend\AuctionItem;
use App\Model\Frontend\CharGold;
use App\Model\Frontend\CharInventory;
use App\Notification;
use App\ServerGold;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AuctionsHouse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auctionshouse:timer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Item checking for time left';

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
        $auctionItems = AuctionItem::with('getItemInformation')->get();
        foreach ($auctionItems as $item) {
            if ($item->until <= Carbon::now() && isset($item->current_bid_user_id)) {
                // Calculating the fees
                $auctionsHouseSettings = AuctionsHouseSettings::first();
                $fees = $auctionsHouseSettings->settings['gold_fees'] ?? 0;
                $userGoldGain = $item->price * ((100 - $fees) / 100);

                // Updating the Item to the User who bid successfully on it
                CharInventory::where('id', $item->getItemInformation->id)
                    ->update([
                        'user_id' => $item->current_bid_user_id
                    ]);

                // Updating the new Gold Amount for the User who are selling it
                CharGold::where('user_id', $item->user_id)
                    ->increment(
                        'gold', $userGoldGain
                    );

                ServerGold::first()->increment(
                    'gold', $item->price - $userGoldGain
                );

                $this->info('Item ' . $item->id . ' Successfully traded to ' . $item->current_bid_user_id);

                // Deleting this Auction
                $item->delete();

                Notification::create([
                    'user_id' => $item->user_id,
                    'key' => __('notification.auctionshouse.item-sold', [
                        'name' => $item->getItemInformation->name,
                        'gold' => $userGoldGain
                    ]),
                ]);

                Notification::create([
                    'user_id' => $item->current_bid_user_id,
                    'key' => __('notification.auctionshouse.item-bought', [
                        'name' => $item->getItemInformation->name,
                        'gold' => $item->price
                    ]),
                ]);

                AuctionsHouseLog::create([
                    'price_sold' => $userGoldGain,
                    'seller_user_id' => $item->user_id,
                    'buyer_user_id' => $item->current_bid_user_id,
                    'state' => AuctionsHouseLog::STATE_SOLD
                ]);
            } else {
                if ($item->until <= Carbon::now()) {
                    AuctionsHouseLog::create([
                        'seller_user_id' => $item->user_id,
                        'state' => AuctionsHouseLog::STATE_NOT_SOLD
                    ]);
                    $item->delete();

                    Notification::create([
                        'user_id' => $item->user_id,
                        'key' => __('notification.auctionshouse.not-sold', [
                            'name' => $item->getItemInformation->name
                        ]),
                    ]);
                }
            }
        }
        return true;
    }
}
