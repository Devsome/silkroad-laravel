<?php

namespace App\Library\Services;

use App\Library\Services\SRO\Shard\InventoryService;
use App\Model\Frontend\CharGold;
use App\Model\Frontend\CharGoldLog;
use App\Model\SRO\Shard\Char;
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
            250
        );

        try {
            $accountInventory = view('frontend.account.webinventory.inventory', [
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
