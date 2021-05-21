<?php

namespace App\Helpers;

use App\Http\Library\Services\SRO\Shard\InventoryService;
use App\Http\Model\SRO\Shard\ItemPoolName;
use App\Http\Model\SRO\Shard\RefObjCommon;
use App\Http\Model\SRO\Shard\RefObjItem;
use App\Model\Backend\ItemMallItemCategories;
use App\Model\Backend\ItemWebMall;
use App\Model\Backend\ItemWebMallAdminLog;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebMallHelper
{
    /**
     * Create Item in web mall
     * @param $item_code
     * @param $quantity
     * @param $silk_price
     * @param $plus
     * @return false|string
     * @throws Exception
     */
    public static function CreateItem($item_code, $quantity, $silk_price, $plus)
    {
        $item = RefObjCommon::where('CodeName128', $item_code)
            ->first();

        if (!$item) {
            return 'Item not found in table _RefObjCommon!';
        }
        $item_category = ItemMallItemCategories::where('TypeID2', $item->TypeID2)
            ->where('TypeID3', $item->TypeID3)
            ->where('TypeID4', $item->TypeID4)
            ->first();

        $item_name = ItemPoolName::where('NameStrID', $item->NameStrID128)
            ->first();

        if (!$item_name) {
            $item_name = "No Name";
        } else {
            $item_name = $item_name->RealName;
        }

        $refObjItem = RefObjItem::where('ID', $item->Link)->first();
        if (!$refObjItem) {
            return 'Item not found in table _RefObjItem!';
        }

        $item_data = array_merge($item->toArray(), $refObjItem->toArray());

        $item_data = (new InventoryService)->ItemStats($item_data, $quantity, $plus);
        $tooltip = '
                    <div class="item-data" id="selectInventory">
                        <div id="items" class="itemslot float-none mx-auto">
                            <div class="image" style="background:url(' . route('images.items', ['image' => $item_data['imgpath']]) . ') no-repeat; background-size: 34px 34px !important; width: 34px; height: 34px !important;" data-iteminfo="1">
                                <span class="qinfo">
                                    ' . (($quantity) ?? $quantity) . '
                                </span>
                                ' . (($item_data['special']) ? '<span class="plus"></span>' : "") . '
                            </div>
                        </div>
                        <div class="itemInfo">
                        ' . (($item_data['data']) ? htmlspecialchars_decode(stripslashes($item_data['data'])) : "") . '
                        </div>
                    </div>
                    ';
        DB::beginTransaction();
        try {
            $data = ItemWebMall::create([
                'item_id' => $item->ID,
                'item_name' => $item_name,
                'CodeName128' => $item_code,
                'gender' => $refObjItem->ReqGender,
                'category_id' => $item_category->id ?? 76,
                'silk_price' => $silk_price,
                'item_quantity' => $quantity,
                'item_plus' => $plus,
                'tooltip' => $tooltip,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return $data;
    }

    /**
     * @param $data
     * @param $type
     */
    public static function createWebMallAdminLog($data, $type): void
    {
        ItemWebMallAdminLog::create([
            'user_id' => Auth::id(),
            'data' => $data,
            'type' => $type
        ]);
    }
}
