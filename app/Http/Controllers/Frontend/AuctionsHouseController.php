<?php

namespace App\Http\Controllers\Frontend;

use App\AuctionsHouseLog;
use App\AuctionsHouseSettings;
use App\Http\Controllers\Controller;
use App\Model\Frontend\AuctionItem;
use App\Model\Frontend\CharGold;
use App\Model\Frontend\CharInventory;
use App\Notification;
use App\ServerGold;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $auctionItems = AuctionItem::where('until', '>', Carbon::now())
            ->with('getItemInformation')
            ->orderBy('until', 'ASC')
            ->get();

        return view(
            'frontend.auctionshouse.index', [
                'items' => $auctionItems
            ]
        );
    }

    /**
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filterType($type = null)
    {
        $type = ucwords(str_replace('-', ' ', $type));
        $auctionItems = AuctionItem::whereHas('getItemInformation', static function ($q) use ($type) {
            $q->where('sort', $type);
        })->get();

        return view(
            'frontend.auctionshouse.index', [
                'items' => $auctionItems
            ]
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showItem($id)
    {
        $auctionItem = AuctionItem::where('id', $id)
            ->with('getItemInformation')
            ->firstOrFail();

        return view(
            'frontend.auctionshouse.showitem', [
                'item' => $auctionItem
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showOwn()
    {
        $auctionItems = AuctionItem::where('user_id', '=', Auth::user()->id)
            ->with('getItemInformation')
            ->get();

        return view(
            'frontend.auctionshouse.own', [
                'items' => $auctionItems
            ]
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelOwn($id)
    {
        $auctionItem = AuctionItem::where('id', $id)->firstOrFail();

        if ($auctionItem->current_bid_user_id) {
            CharGold::where('user_id', $auctionItem->current_bid_user_id)
                ->increment(
                    'gold', $auctionItem->current_user_bid_amount
                );
        }

        $auctionItem->delete();

        return back()->with('success', __('auctionshouse.notification.cancel.successfully'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAddItem()
    {
        $webInventory = CharInventory::select('*')->whereNotIn('id', static function ($query) {
            $query->select('char_inventory')->from('auction_items');
        })
            ->where('user_id', '=', Auth::id())
            ->get();

        return view(
            'frontend.auctionshouse.add', [
                'webInventory' => $webInventory,
                'auctionsHouseSettings' => AuctionsHouseSettings::first()
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
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

        AuctionItem::create([
            'user_id' => Auth::user()->id,
            'char_inventory' => $isThisHisItem->first()->id,
            'until' => $request->get('until'),
            'price' => $request->get('price'),
            'price_instead' => $request->get('price_instead'),
        ]);

        return back()->with('success', trans('auctionshouse.notification.add.successfully'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
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
                'gold', $buyNowPrice - $userGoldGain
            );

            // The Account who sold it need that gold
            CharGold::where('user_id', $sellerUserId)
                ->increment(
                    'gold', $userGoldGain
                );

            // Giving the user who bid the last the gold amount back
            if ($currentAuctionBidUser) {
                CharGold::where('user_id', $currentAuctionBidUser->current_bid_user_id)
                    ->increment(
                        'gold', $currentAuctionBidUser->current_user_bid_amount
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

        return redirect()->route('auctions-house')->with('success', __('auctionshouse.notification.buy.successfully'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
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

        if ($userNewBidPrice >= $auctionItem->price_instead) {
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
                        'gold', $currentAuctionItem->current_user_bid_amount
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
                    'bids', 1
                );

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            return back()->with('error', trans('auctionshouse.notification.bid.error'));
        }

        return back()->with('success', __('auctionshouse.notification.bid.successfully'));
    }
}
