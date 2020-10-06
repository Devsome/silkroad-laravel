<?php

namespace App\Library\Services;

use App\Library\Services\SRO\Shard\InventoryService;
use App\Model\Frontend\CharGold;
use App\Model\Frontend\CharGoldLog;
use App\Model\Frontend\CharInventory;
use App\Model\Frontend\CharInventoryLog;
use App\Model\SRO\Shard\Char;
use App\Model\SRO\Shard\Inventory;
use App\Model\SRO\Shard\Items;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;


/**
 * Class WebInventoryService
 * @package App\Library\Services
 */
class WebInventoryService
{
    /** @var InventoryService */
    private $inventory;

    /**
     * VouchersService constructor.
     * @param InventoryService $inventory
     */
    public function __construct(InventoryService $inventory)
    {
        $this->inventory = $inventory;
    }

    /**
     * Get the Character and Gold as a Service
     * @param $characterId
     * @param $account
     * @return array
     */
    public function getCharacterAndGold($characterId, $account): array
    {
        $checkState = $this->checkIfCharOwnAndLoggedOut($characterId, $account);
        if (!$checkState['state'] === true) {
            return [
                'state' => false,
                'error' => $checkState['error']
            ];
        }

        $accountInventory = $this->inventory->getInventorySet(
            $characterId,
            250,
            13
        );

        try {
            $accountInventory = view('frontend.account.webinventory.game-inventory', [
                'aItem' => $accountInventory
            ])->render();
        } catch (\Throwable $e) {
//            Throw error
        }

        $goldArray = $this->formatGoldAndNone(
            $account->getTbUser->getShardUser->where('CharID', $characterId)->first()->RemainGold
        );

        return [
            'state' => true,
            'characterId' => $characterId,
            'accountGoldFormatted' => $goldArray['formatted'],
            'accountGold' => $goldArray['nonFormatted'],
            'accountInventory' => $accountInventory
        ];
    }

    /**
     * Updating the Gold Amount for that User + Change Silkroad Gold Amount
     * @param $characterId
     * @param $account
     * @param int $deposit
     * @return array
     * @throws \Exception
     */
    public function updateGoldDeposit($characterId, $account, $deposit = 0): array
    {
        $checkState = $this->checkIfCharOwnAndLoggedOut($characterId, $account);
        if (!$checkState['state'] === true) {
            return [
                'state' => false,
                'error' => ['data' => $checkState['error']]
            ];
        }

        $char = Char::where('CharID', '=', $characterId)
            ->firstOrFail();

        if ($deposit > $char->RemainGold) {
            return [
                'state' => false,
                'error' => ['data' => __('webinventory.not-enough-gold-game')]
            ];
        }

        $goldResponse = $this->updateGold(
            $characterId, $deposit, true
        );

        if (!$goldResponse['state'] === true) {
            return [
                'state' => false,
                'error' => ['data' => $goldResponse['error'], 'e' => $goldResponse['e']]
            ];
        }

        $goldArray = $this->formatGoldAndNone(
            $char->RemainGold - $deposit
        );

        $goldWebArray = $this->formatGoldAndNone(
            CharGold::where('user_id', Auth::id())->sum('gold')
        );

        return [
            'state' => true,
            'goldArray' => $goldArray,
            'goldWebArray' => $goldWebArray
        ];
    }

    /**
     * Updating the Gold Amount for that User + Change Silkroad Gold Amount
     * @param $characterId
     * @param $account
     * @param int $withdraw
     * @return array
     * @throws \Exception
     */
    public function updateGoldWithdraw($characterId, $account, $withdraw = 0): array
    {
        $checkState = $this->checkIfCharOwnAndLoggedOut($characterId, $account);
        if (!$checkState['state'] === true) {
            return [
                'state' => false,
                'error' => ['data' => $checkState['error']]
            ];
        }

        $webInventoryGold = CharGold::where('user_id', '=', Auth::id())
            ->firstOrFail();

        if ($withdraw > $webInventoryGold->gold) {
            return [
                'state' => false,
                'error' => ['data' => __('webinventory.not-enough-gold-web')]
            ];
        }

        $goldResponse = $this->updateGold(
            $characterId, $withdraw, false, true
        );

        if (!$goldResponse['state'] === true) {
            return [
                'state' => false,
                'error' => ['data' => $goldResponse['error'], 'e' => $goldResponse['e']],
            ];
        }

        $char = Char::where('CharID', '=', $characterId)
            ->firstOrFail();

        $goldArray = $this->formatGoldAndNone(
            $char->RemainGold
        );

        $goldWebArray = $this->formatGoldAndNone(
            CharGold::where('user_id', Auth::id())->sum('gold')
        );

        return [
            'state' => true,
            'goldArray' => $goldArray,
            'goldWebArray' => $goldWebArray
        ];
    }

    /**
     * Transfer that Item and returning the result to the Controller
     * @param $characterId
     * @param $account
     * @param $serial64
     * @return array
     * @throws \Exception
     */
    public function transferItemToWeb($characterId, $account, $serial64): array
    {
        $checkState = $this->checkIfCharOwnAndLoggedOut($characterId, $account);
        if (!$checkState['state'] === true) {
            return [
                'state' => false,
                'error' => ['data' => $checkState['error']]
            ];
        }

        $inventory = Inventory::where('CharID', '=', $characterId)
            ->where('ItemID', '!=', 0)
            ->with(['getSerial64' => static function ($query) {
                $query->select('ID64', 'Serial64');
            }])->get();

        $inventorySerial64Array = $inventory->pluck('getSerial64')->pluck('Serial64')->toArray();

        $canTrade = Items::where('Serial64', '=', $serial64)
            ->with('getRefObjCommonCanTrade')
            ->firstOrFail();

        if($canTrade->getRefObjCommonCanTrade->CanTrade === 0)
        {
            return [
                'state' => false,
                'error' => ['data' => __('webinventory.cannot-trade')]
            ];
        }

        if (in_array($serial64, $inventorySerial64Array, false)) {
            $itemMoveResponse = $this->itemMoveToWeb($characterId, $serial64);

            if (!$itemMoveResponse['state'] === true) {
                return [
                    'state' => false,
                    'error' => ['data' => $itemMoveResponse['error'], 'e' => $itemMoveResponse['e']]
                ];
            }
        } else {
            return [
                'state' => false,
                'error' => ['data' => __('webinventory.not-your-item')]
            ];
        }

        return [
            'state' => true
        ];
    }

    /**
     * Transfer that Item and returning the result to the Controller
     * @param $characterId
     * @param $account
     * @param $serial64
     * @return array
     * @throws \Exception
     */
    public function transferItemToGame($characterId, $account, $serial64): array
    {
        $checkState = $this->checkIfCharOwnAndLoggedOut($characterId, $account);
        if (!$checkState['state'] === true) {
            return [
                'state' => false,
                'error' => ['data' => $checkState['error']]
            ];
        }

        $charMaxInventory = Char::where('CharID', '=', $characterId)
            ->select('InventorySize')
            ->firstOrFail();

        $inventoryGameFreeSlot = Inventory::where('CharID', '=', $characterId)
            ->where('Slot', '>=', 13)
            ->where('Slot', '<', $charMaxInventory->InventorySize)
            ->where('ItemID', '=', 0)
            ->get();

        if($inventoryGameFreeSlot->count() === 0) {
            return [
                'state' => false,
                'error' => ['data' => __('webinventory.no-ingame-slot-left')]
            ];
        }

        $itemMoveResponse = $this->itemMoveToGame($characterId, $inventoryGameFreeSlot->first()->Slot, $serial64);
        if (!$itemMoveResponse['state'] === true) {
            return [
                'state' => false,
                'error' => ['data' => $itemMoveResponse['error'], 'e' => $itemMoveResponse['e']]
            ];
        }

        return [
            'state' => true
        ];
    }

    /**
     * Updating the Gold for that User + Silkroad
     * @param $characterId
     * @param int $amount
     * @param bool $deposit
     * @param bool $withdraw
     * @return array
     * @throws \Exception
     */
    private function updateGold($characterId, $amount = 0, $deposit = false, $withdraw = false): array
    {
        DB::beginTransaction();
        DB::connection('shard')->beginTransaction();
        try {
            $charGold = CharGold::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                ],
                [
                    'user_id' => Auth::id(),
                ]
            );

            if ($deposit) {
                $charGold->increment('gold', $amount);
                $this->updateGoldLog($characterId, $amount, null);

                Char::where('CharID', $characterId)->decrement('RemainGold', $amount);
            }
            if ($withdraw) {
                $charGold->decrement('gold', $amount);
                $this->updateGoldLog($characterId, null, $amount);

                Char::where('CharID', $characterId)->increment('RemainGold', $amount);
            }
            $charGold->save();

            DB::commit();
            DB::connection('shard')->commit();
        } catch (Throwable $e) {
            DB::rollback();
            DB::connection('shard')->rollback();
            return [
                'state' => false,
                'error' => 'Action rollback, try again please!',
                'e' => $e
            ];
        }
        return [
            'state' => true
        ];
    }

    /**
     * Logging the Gold Transaction
     * @param $characterId
     * @param null $deposit
     * @param null $withdraw
     */
    private function updateGoldLog($characterId, $deposit = null, $withdraw = null): void
    {
        CharGoldLog::create([
            'user_id' => Auth::id(),
            'from_charid' => $characterId,
            'deposit' => $deposit,
            'withdraw' => $withdraw
        ]);
    }

    /**
     * Moving the Item from Silkroad to Web Database
     * @param $characterId
     * @param $serial64
     * @return array
     * @throws \Exception
     */
    private function itemMoveToWeb($characterId, $serial64): array
    {
        DB::beginTransaction();
        DB::connection('shard')->beginTransaction();
        try {
            // Getting the ID64 (ItemID) from the Serial64
            $item = Items::where('Serial64', $serial64)
                ->select('ID64')
                ->firstOrFail();

            // Removing the Item from the Inventory
            Inventory::where('ItemID', '=', $item->ID64)
                ->update(
                    [
                        'ItemID' => 0
                    ]
                );

            // Getting the Item Information (less sql queries when getting them back)
            $itemData = $this->inventory->getInventorySlotData($serial64);
            $itemData = current($itemData);

            // Remove GM Info from the Item (dunno why GM should put item into Web Storage)
            $itemData['data'] = preg_replace(
                '/<\/?div id="gm-info"[^>]*\>(.+?)<\/div>/is',
                '',
                $itemData['data']
            );

            $webName = data_get($itemData['WebInventory'], 'WebName', 'Unknown Name');
            $optLevel = data_get($itemData['WebInventory'], 'OptLevel', 0);
            $type = data_get($itemData['WebInventory'], 'Type', 'Unknown');
            $special = data_get($itemData['WebInventory'], 'special', '0');
            $amount = data_get($itemData, 'amount', 0);
            $sex = data_get($itemData['WebInventory'], 'Sex', 'Unknown');
            $race = data_get($itemData['WebInventory'], 'Race', '');
            $price = data_get($itemData['WebInventory'], 'Price', '');
            $reqLevel = data_get($itemData['WebInventory'], 'ReqLevel1', 0);
            $degree = data_get($itemData['WebInventory'], 'Degree', 0);

            // Putting that Item into the Web Database
            CharInventory::create([
                'user_id' => Auth::id(),
                'from_charid' => $characterId,
                'serial64' => $serial64,
                'item_id64' => $item->ID64,
                'name' => $webName,
                'imgpath' => $itemData['imgpath'],
                'optlevel' => $optLevel,
                'amount' => $amount,
                'special' => $special,
                'sort' => $type,
                'degree' => $degree,
                'level' => $reqLevel,
                'npc_price' => $price,
                'race' => $race,
                'sex' => $sex,
                'data' => $itemData['data']
            ]);

            // Logging that Item Movement
            $this->transferItemLog($characterId, 'deposit', $serial64, $item->ID64);

            DB::commit();
            DB::connection('shard')->commit();
        } catch (Throwable $e) {
            DB::rollback();
            DB::connection('shard')->rollback();
            return [
                'state' => false,
                'error' => 'Action rollback, try again please!',
                'e' => $e
            ];
        }
        return [
            'state' => true
        ];
    }

    /**
     * Moving the Item from Web Database to Silkroad
     * @param $characterId
     * @param $slot
     * @param $serial64
     * @return array
     * @throws \Exception
     */
    private function itemMoveToGame($characterId, $slot, $serial64): array
    {
        DB::beginTransaction();
        DB::connection('shard')->beginTransaction();
        try {
            // Getting the ItemID64 from the Web Inventory
            $webInventory = CharInventory::select('*')->whereNotIn('id', static function ($query) {
                $query->select('char_inventory')->from('auction_items');
            })
                ->where('user_id', '=', Auth::id())
                ->where('serial64', '=', $serial64)
                ->firstOrFail();

            // Putting that Item into the Characters Inventory
            Inventory::where('CharID', '=', $characterId)
                ->where('Slot', '=', $slot)
                ->update(
                    [
                        'ItemID' => $webInventory->item_id64
                    ]
                );

            // Logging that Item Movement
            $this->transferItemLog($characterId, 'withdraw', $serial64, $webInventory->item_id64);

            // Final Remove of the Item from the Web Inventory
            $webInventory->delete();

            DB::commit();
            DB::connection('shard')->commit();
        } catch (Throwable $e) {
            DB::rollback();
            DB::connection('shard')->rollback();
            return [
                'state' => false,
                'error' => 'Action rollback, try again please!',
                'e' => $e
            ];
        }
        return [
            'state' => true
        ];
    }

    /**
     * Logging the Transfer Item Transaction
     * @param $characterId
     * @param $state
     * @param $serial64
     * @param $itemId64
     */
    private function transferItemLog($characterId, $state, $serial64, $itemId64): void
    {
        CharInventoryLog::create([
            'user_id' => Auth::id(),
            'from_charid' => $characterId,
            'state' => $state,
            'serial64' => $serial64,
            'item_id64' => $itemId64
        ]);
    }

    /**
     * @param null $array
     * @return array
     */
    private function array_flatten($array = null): array {
        $result = array();

        if (!is_array($array)) {
            $array = func_get_args();
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                /** @noinspection SlowArrayOperationsInLoopInspection */
                $result = array_merge($result, $this->array_flatten($value));
            } else {
                /** @noinspection SlowArrayOperationsInLoopInspection */
                $result = array_merge($result, array($key => $value));
            }
        }

        return $result;
    }

    /**
     * Getting the Web Item Inventory from Auth::id()
     * @return array
     */
    public function getInventoryFromAuth(): array
    {
        $webInventory = CharInventory::select('*')->whereNotIn('id', static function ($query) {
            $query->select('char_inventory')->from('auction_items');
        })
            ->where('user_id', '=', Auth::id())
            ->get();

        try {
            $accountInventory = view('frontend.account.webinventory.web-inventory', [
                'aItem' => $webInventory
            ])->render();
        } catch (\Throwable $e) {
            $accountInventory = [];
        }

        return [
            'state' => true,
            'data' => $accountInventory
        ];
    }

    /**
     * Check if the Character is logged in & owns
     * @param $characterId
     * @param $account
     * @return array
     */
    private function checkIfCharOwnAndLoggedOut($characterId, $account): array
    {
        if (
        !in_array(
            $characterId,
            $account->getTbUser->getShardUser->pluck('CharID')->toArray(),
            false
        )
        ) {
            return ['state' => false, 'error' => 'Error Code: 1 [Wrong Character]'];
        }

        $loggedState = $account->getTbUser->getShardUser->where('CharID', $characterId)->first()->getCharOnlineOfflineLoggedIn;
        if ($loggedState) {
            return ['state' => false, 'error' => __('webinventory.logged-in')];
        }

        return ['state' => true];
    }

    /**
     * Format the Gold
     * @param $remainGold
     * @return array
     */
    private function formatGoldAndNone($remainGold): array
    {
        $goldFormatted = number_format($remainGold, 0, ',', '.');
        return [
            'formatted' => $goldFormatted,
            'nonFormatted' => $remainGold
        ];
    }
}
