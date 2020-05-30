<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Frontend\AuctionItem;
use App\Model\Frontend\CharGold;
use App\Model\Frontend\CharInventory;
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
            ->get();

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
    public function showAddItem()
    {
        $webInventory = CharInventory::select('*')->whereNotIn('id', static function ($query) {
            $query->select('char_inventory')->from('auction_items');
        })
            ->where('user_id', '=', Auth::id())
            ->get();

        return view(
            'frontend.auctionshouse.add', [
                'webInventory' => $webInventory
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
            'until' => ['required', 'date'],
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

    public function submitBuyItemNow($id, Request $request)
    {
        // Functions for buying that Item
        // Checking if the Item exist
        // Checking if the price is okay and higher

        $auctionItem = AuctionItem::where('id', $id)
            ->with('getItemInformation')
            ->firstOrFail();

        $buyNowPrice = $auctionItem->price_instead;
        $sellerUserId = $auctionItem->getItemInformation->user_id;
        $currentCharGold = CharGold::where('user_id', Auth::id())->sum('gold');

        if($currentCharGold < $buyNowPrice) {
            return back()->with('error', trans('auctionshouse.notification.buy.not-enough-gold'));
        }

        if($auctionItem->until < Carbon::now()) {
            return back()->with('error', trans('auctionshouse.notification.buy.until'));
        }

        $this->validate($request, [
            '_token' => 'required',
        ]);


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

            // The Account who sold it need that gold
            CharGold::where('user_id', $sellerUserId)
                ->increment(
                    'gold', $buyNowPrice
                );

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            return back()->with('error', trans('auctionshouse.notification.buy.error'));
        }

        return redirect()->route('auctions-house')->with('success', __('auctionshouse.notification.buy.successfully'));
    }
}
