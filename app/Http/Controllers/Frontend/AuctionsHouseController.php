<?php

namespace App\Http\Controllers\Frontend;

use App\AuctionsHouseLog;
use App\AuctionsHouseSettings;
use App\DataTables\Frontend\AuctionHouse\AuctionHouseDataTable;
use App\Http\Controllers\Controller;
use App\Model\Frontend\AuctionItem;
use App\Model\Frontend\CharGold;
use App\Model\Frontend\CharInventory;
use App\Notification;
use App\Notifications\AuctionDiscordServer;
use App\ServerGold;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class AuctionsHouseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param AuctionHouseDataTable $dataTable
     * @param string $mode
     * @return void
     */
    public function index(AuctionHouseDataTable $dataTable, $mode = 'all')
    {
        if (!in_array($mode, ['all', 'own', 'filter'], true)) {
            return abort(404);
        }

        return $dataTable->with(['mode' => $mode])->render('theme::frontend.auctionshouse.index', ['mode' => $mode, 'filter' => 'none']);
    }

    /**
     * @param AuctionHouseDataTable $dataTable
     * @param null $type
     * @return Factory|View
     */
    public function filterType(AuctionHouseDataTable $dataTable, $type = null)
    {
        return $dataTable->with(['mode' => 'filter', 'type' => $type])->render('theme::frontend.auctionshouse.index', ['mode' => 'filter', 'filter' => $type]);
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function showItem($id)
    {
        $auctionItem = AuctionItem::where('id', $id)
            ->with('getItemInformation')
            ->firstOrFail();

        return view(
            'theme::frontend.auctionshouse.showitem',
            [
                'item' => $auctionItem,
                'filter' => null
            ]
        );
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    public function cancelOwn($id)
    {
        $auctionItem = AuctionItem::find($id);

        DB::beginTransaction();
        try {
            if (isset($auctionItem->current_bid_user_id)) {
                CharGold::where('user_id', $auctionItem->current_bid_user_id)
                    ->increment(
                        'gold',
                        $auctionItem->current_user_bid_amount
                    );
            }
            $auctionItem->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json('error', 500);
        }
        DB::commit();
        return response()->json('success', 200);
    }

    /**
     * @return Factory|View
     */
    public function showAddItem()
    {
        $webInventory = CharInventory::select('*')->whereNotIn('id', static function ($query) {
            $query->select('char_inventory')->from('auction_items');
        })
            ->where('user_id', '=', Auth::id())
            ->get();

        return view(
            'theme::frontend.auctionshouse.add',
            [
                'webInventory' => $webInventory,
                'auctionsHouseSettings' => AuctionsHouseSettings::first(),
                'filter' => null
            ]
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function submitAddItem(Request $request)
    {
        $this->validate($request, [
            '_token' => 'required',
            'price' => ['required', 'integer'],
            'price_instead' => ['nullable', 'integer'],
            'until' => ['required', 'date', 'after_or_equal:now'],
            'serial64' => ['required']
        ]);

        if ($request->get('price_instead') &&
            $request->get('price_instead') < $request->get('price')) {
            return back()->with('error', trans('auctionshouse.notification.add.price'));
        }

        $isThisHisItem = CharInventory::where('user_id', Auth::user()->id)
            ->where('serial64', $request->get('serial64'))
            ->get();

        if (count($isThisHisItem) < 1) {
            return back()->with('error', trans('auctionshouse.notification.add.not-item'));
        }

        $auctionItem = AuctionItem::create([
            'user_id' => Auth::user()->id,
            'char_inventory' => $isThisHisItem->first()->id,
            'until' => $request->get('until') ?: '0',
            'price' => $request->get('price') ?: 0,
            'price_instead' => $request->get('price_instead') ?: 0,
        ]);

        if (config('services.discord.auction')) {
            try {
                $auctionItem->notify(new AuctionDiscordServer($auctionItem, $isThisHisItem->first()));
            } catch (Exception $exception) {
                return back()->with('success', trans('auctionshouse.notification.add.successfully'));
            }
        }

        return back()->with('success', trans('auctionshouse.notification.add.successfully'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function submitBuyItemNow($id, Request $request)
    {
        $auctionItem = AuctionItem::where('id', $id)
            ->with('getItemInformation')
            ->firstOrFail();

        $buyNowPrice = $auctionItem->price_instead;
        $sellerUserId = $auctionItem->getItemInformation->user_id;
        $currentCharGold = CharGold::where('user_id', Auth::id())->sum('gold');

        if ($currentCharGold < $buyNowPrice) {
            return back()->with('error', trans('auctionshouse.notification.buy.not-enough-gold'));
        }

        if ($auctionItem->until < Carbon::now()) {
            return back()->with('error', trans('auctionshouse.notification.buy.until'));
        }

        if ($buyNowPrice === 0) {
            return back()->with('error', trans('auctionshouse.notification.buy.price-0'));
        }

        $this->validate($request, [
            '_token' => 'required',
        ]);

        $currentAuctionBidUser = AuctionItem::where('id', $id)
            ->whereNotNull('current_bid_user_id')
            ->get()->first();


        DB::beginTransaction();
        try {
            // Getting the new Account Gold amount
            $newGoldAmount = $currentCharGold - $buyNowPrice;

            // Getting the Item from the old Web Char Inventory
            CharInventory::where('id', $auctionItem->getItemInformation->id)
                ->update([
                    'user_id' => Auth::user()->id
                ]);

            // Giving the Person who bid on that Item the gold back
            if (isset($auctionItem->current_bid_user_id)) {
                CharGold::where('user_id', $auctionItem->current_bid_user_id)
                    ->increment(
                        'gold',
                        $auctionItem->current_user_bid_amount
                    );
            }

            // Deleting this Auction
            AuctionItem::where('id', $id)->delete();

            // Updating the new Gold Amount
            CharGold::where('user_id', Auth::user()->id)
                ->update([
                    'gold' => $newGoldAmount
                ]);

            $auctionsHouseSettings = AuctionsHouseSettings::first();
            $fees = $auctionsHouseSettings->settings['gold_fees'] ?? 0;
            $userGoldGain = $buyNowPrice * ((100 - $fees) / 100);

            ServerGold::first()->increment(
                'gold',
                $buyNowPrice - $userGoldGain
            );

            // The Account who sold it need that gold
            $sellerGold = CharGold::where('user_id', $sellerUserId)
                ->get()
                ->first();
            if ($sellerGold === null) {
                CharGold::create([
                    'user_id' => $sellerUserId,
                    'gold' => $userGoldGain
                ]);
            } else {
                CharGold::where('user_id', $sellerUserId)
                    ->increment(
                        'gold',
                        $userGoldGain
                    );
            }

            // Giving the user who bid the last the gold amount back
            if ($currentAuctionBidUser) {
                CharGold::where('user_id', $currentAuctionBidUser->current_bid_user_id)
                    ->increment(
                        'gold',
                        $currentAuctionBidUser->current_user_bid_amount
                    );
            }


            // Notification for the User who sold that item
            Notification::create([
                'user_id' => $sellerUserId,
                'key' => __('notification.auctionshouse.item-sold', [
                    'name' => $auctionItem->getItemInformation->name,
                    'gold' => $userGoldGain
                ]),
            ]);

            Notification::create([
                'user_id' => Auth::user()->id,
                'key' => __('notification.auctionshouse.item-bought', [
                    'name' => $auctionItem->getItemInformation->name,
                    'gold' => $buyNowPrice
                ]),
            ]);

            AuctionsHouseLog::create([
                'price_sold' => $buyNowPrice,
                'seller_user_id' => $sellerUserId,
                'buyer_user_id' => Auth::user()->id,
                'state' => AuctionsHouseLog::STATE_SOLD
            ]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            return back()->with('error', trans('auctionshouse.notification.buy.error'));
        }

        return redirect()->route('auctions-house')
            ->with('success', __('auctionshouse.notification.buy.successfully'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function submitBidItem($id, Request $request)
    {
        $auctionItem = AuctionItem::where('id', $id)
            ->with('getItemInformation')
            ->firstOrFail();

        $currentBidPrice = $auctionItem->price;
        $currentCharGold = CharGold::where('user_id', Auth::id())->sum('gold');
        $userNewBidPrice = $request->get('auctionBidPrice');

        if ($currentCharGold < $currentBidPrice) {
            return back()->with('error', trans('auctionshouse.notification.bid.not-enough-gold'));
        }

        if ($auctionItem->until < Carbon::now()) {
            return back()->with('error', trans('auctionshouse.notification.bid.until'));
        }

        if ($auctionItem->price > $userNewBidPrice) {
            return back()->with('error', trans('auctionshouse.notification.bid.not-highest'));
        }

        if (($auctionItem->price_instead > 0) && $userNewBidPrice >= $auctionItem->price_instead) {
            return back()->with('error', trans('auctionshouse.notification.bid.bid-higher'));
        }

        $this->validate($request, [
            '_token' => 'required',
            'auctionBidPrice' => 'required|integer'
        ]);

        $currentAuctionItem = AuctionItem::where('id', $id)
            ->whereNotNull('current_bid_user_id')
            ->get()->first();

        if (isset($currentAuctionItem->current_bid_user_id) &&
            $currentAuctionItem->current_bid_user_id === Auth::user()->id) {
            return back()->with('error', trans('auctionshouse.notification.bid.already'));
        }

        DB::beginTransaction();
        try {
            // Getting the new Account Gold amount
            $newGoldAmount = $currentCharGold - $userNewBidPrice;

            // Giving the old Bidder the Gold amount back
            if ($currentAuctionItem) {
                CharGold::where('user_id', $currentAuctionItem->current_bid_user_id)
                    ->increment(
                        'gold',
                        $currentAuctionItem->current_user_bid_amount
                    );
                Notification::create([
                    'user_id' => $currentAuctionItem->current_bid_user_id,
                    'key' => __('notification.auctionshouse.over-bid', [
                        'gold' => $userNewBidPrice
                    ]),
                    'url' => route('auctions-house-show-item', ['id' => $id])
                ]);
            }

            // Updating the new Gold Amount
            CharGold::where('user_id', Auth::user()->id)
                ->update([
                    'gold' => $newGoldAmount
                ]);

            AuctionItem::where('id', $id)->update([
                'price' => $userNewBidPrice,
                'current_bid_user_id' => Auth::user()->id,
                'current_user_bid_amount' => $userNewBidPrice
            ]);

            AuctionItem::where('id', $id)
                ->increment(
                    'bids',
                    1
                );

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            return back()->with('error', trans('auctionshouse.notification.bid.error'));
        }

        return back()->with('success', __('auctionshouse.notification.bid.successfully'));
    }
}
