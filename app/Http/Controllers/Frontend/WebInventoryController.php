<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\Services\WebInventoryService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class WebInventoryController extends Controller
{
    /**
     * Showing all the Characters for that User
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $account = User::where('id', Auth::id())
            ->with('getTbUser.getShardUser')
            ->firstOrFail();

        return view('frontend.account.webinventory.index', [
            'account' => $account
        ]);
    }

    /**
     * Ajax select the Character, get the Inventory and Gold
     * @param Request $request
     * @param WebInventoryService $webInventoryService
     * @return \Illuminate\Http\JsonResponse
     */
    public function selectCharacter(
        Request $request,
        WebInventoryService $webInventoryService
    )
    {
        $validator = Validator::make($request->all(), [
            'characterId' => 'required|int',
            '_token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 500);
        }

        $account = User::where('id', Auth::id())
            ->with('getTbUser.getShardUser')
            ->with('getTbUser.getShardUser.getCharOnlineOfflineLoggedIn')
            ->firstOrFail();

        $accountResponse = $webInventoryService->getCharacterAndGold(
            $request->get('characterId'),
            $account
        );

        if ($accountResponse['state'] === false) {
            return response()->json([
                'error' => $accountResponse['error']
            ], 401);
        }

        return response()->json([
            'characterId' => $accountResponse['characterId'],
            'accountGoldFormatted' => $accountResponse['accountGoldFormatted'],
            'accountGold' => $accountResponse['accountGold'],
            'accountInventory' => $accountResponse['accountInventory']
        ], 200);
    }

    /**
     * @param Request $request
     * @param WebInventoryService $webInventoryService
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateGold(
        Request $request,
        WebInventoryService $webInventoryService
    )
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|gt:0',
            'characterId' => 'required|int',
            'action' => 'required',
            '_token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 500);
        }

        $account = User::where('id', Auth::id())
            ->with('getTbUser.getShardUser')
            ->with('getTbUser.getShardUser.getCharOnlineOfflineLoggedIn')
            ->firstOrFail();

        if ($request->get('action') === 'gameweb') {
            $goldResponse = $webInventoryService->updateGoldDeposit(
                $request->get('characterId'),
                $account,
                $request->get('amount')
            );
        }

        if ($request->get('action') === 'webgame') {
            $goldResponse = $webInventoryService->updateGoldWithdraw(
                $request->get('characterId'),
                $account,
                $request->get('amount')
            );
        }

        if (isset($goldResponse)) {
            if ($goldResponse['state'] === false) {
                return response()->json([
                    'error' => $goldResponse['error']
                ], 400);
            }

            return response()->json(
                [
                    'data' => __('webinventory.submit-gold-success'),
                    'gold' => $goldResponse['goldArray']
                ], 200);
        }

        return response()->json([
            'error' => 'Something went wrong, please try again'
        ], 400);

    }
}
