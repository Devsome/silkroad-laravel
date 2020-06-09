<?php

namespace App\Providers;

use App\Model\Frontend\AuctionItem;
use App\Model\Frontend\CharGold;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class SilkGoldProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'frontend.account.sidebar',
            static function ($view) {
                $data = [];
                if (Auth::id()) {
                    $charGold = CharGold::where('user_id', Auth::id())->sum('gold');

                    $silk = User::where('id', Auth::id())
                        ->with('getSkSilk')
                        ->firstOrFail();
                    $data = [
                        'silk' => $silk->getSkSilk->silk_own,
                        'silk_gift' => $silk->getSkSilk->silk_gift,
                        'web_inventory_gold' => $charGold
                    ];
                }
                $view->with('SilkGoldProvider', $data);
            }
        );

        view()->composer(
            'frontend.account.auctionsidebar',
            static function ($view) {
                $data = [];

                $auctionsItemFilter = AuctionItem::with('getItemSortForFilter')
                    ->get()
                    ->pluck('getItemSortForFilter.sort')
                    ->toArray();
                $auctionsItemFilter = array_unique($auctionsItemFilter);
                asort($auctionsItemFilter);
                // @Todo map the Sort with Silkroad Icons

                if (Auth::id()) {
                    $charGold = CharGold::where('user_id', Auth::id())->sum('gold');

                    $data = [
                        'web_inventory_gold' => $charGold,
                        'filter' => $auctionsItemFilter
                    ];
                }
                $view->with('GoldProvider', $data);
            }
        );
    }
}
