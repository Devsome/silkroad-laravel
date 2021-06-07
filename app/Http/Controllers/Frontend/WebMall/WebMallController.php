<?php

namespace App\Http\Controllers\Frontend\WebMall;

use App\Http\Controllers\Controller;
use App\Model\Backend\ItemMallItemCategories;
use App\Model\Backend\ItemWebMall;
use App\Model\Backend\ItemWebMallPurchaseLog;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebMallController extends Controller
{
    public const Garment = [
        1, 2, 3, 4, 5, 6
    ];
    public const Protector = [
        7, 8, 9, 10, 11, 12
    ];
    public const Armor = [
        13, 14, 15, 16, 17, 18
    ];
    public const Robe = [
        38, 39, 40, 41, 42, 43
    ];
    public const Light_Armor = [
        44, 45, 46, 47, 48, 49
    ];
    public const Heavy_Armor = [
        50, 51, 52, 53, 54, 55
    ];
    public const Accessory = [
        21, 22, 23, 56, 57, 58
    ];
    public const Weapon = [
        24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37
    ];
    public const Shield = [
        19, 20
    ];
    public const Avatars = [
        59, 60, 61
    ];
    public const Devils = [
        62
    ];
    public const Scrolls = [
        63, 64
    ];
    public const Coins = [
        65
    ];
    public const Elixirs = [
        66, 67, 68
    ];
    public const Stones = [
        66, 67, 68
    ];
    public const FTW = [
        75
    ];
    public const ETC = [
        76
    ];
    public const PETS = [
        77, 78
    ];

    /**
     * @return Application|Factory|View|void
     */
    public function index()
    {
        if (!Auth::check()) {
            return abort(403);
        }

        $webmall = ItemWebMall::OrderBy('created_at', 'DESC')
            ->get();
        return view('theme::frontend.account.webmall', ['webmall' => $webmall]);
    }

    /**
     * @param Request|null $request
     * @return Application|Factory|View|void
     */
    public function filter(Request $request)
    {
        if (!Auth::check()) {
            return abort(403);
        }
        $request->validate([
            'race' => ['required', 'in:0,1,2'],
            'filter' => ['required', 'string'],
        ]);

        if ($request->filter != 'All') {
            $constant = constant('self::' . $request->filter);
            $category_id = ItemMallItemCategories::whereIn('id', $constant);
        } else {
            $category_id = ItemMallItemCategories::OrderBy('id', 'DESC');
        }
        if ($request->race >= 1) {
            $category_id->where('race', $request->race);
        }
        $category_id = $category_id->pluck('id');
        $webmall = ItemWebMall::OrderBy('created_at', 'DESC');
        $webmall->whereIn('category_id', $category_id);
        $webmall = $webmall->get();
        $request->flash();
        return view('theme::frontend.account.webmall', ['webmall' => $webmall]);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    public function purchaseItem($id): JsonResponse
    {
        if (!Auth::check()) {
            return abort(403);
        }

        $item = ItemWebMall::find($id);
        if (!$item) {
            return response()->json(['error' => "Item couldn't be found."]);
        }
        $user = auth()->user()->getSkSilk;
        if ($user->silk_own < $item->silk_price) {
            return response()->json(['error' => 'Transaction failed, Insufficient ' . config('siteSettings.sro_silk_name', 'Silk')], 500);
        }
        DB::beginTransaction();
        try {
            $user->silk_own -= $item->silk_price;
            DB::connection('shard')->statement('EXEC _ADD_ITEM_EXTERN_CHEST ?,?,?,?', [
                auth()->user()->silkroad_id,
                $item->CodeName128,
                $item->item_quantity,
                $item->item_plus
            ]);
            $user->save();

            $log = ItemWebMallPurchaseLog::create([
                'item_id' => $item->id,
                'user_id' => Auth::id(),
                'quantity' => $item->item_quantity,
                'plus' => $item->item_plus,
                'total_paid' => $item->silk_price
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error occurred, Please try again later.'], 500);
        }
        DB::commit();
        return response()->json(true, 200);
    }
}
