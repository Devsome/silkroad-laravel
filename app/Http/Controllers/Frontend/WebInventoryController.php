<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Library\Services\WebInventoryService;
use App\Model\Frontend\CharGold;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class WebInventoryController extends Controller
{

    /**
     * WebInventoryController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Showing all the Characters for that User
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $account = User::where('id', Auth::id())
            ->with('getTbUser.getShardUser')
            ->firstOrFail();

        $webGold = CharGold::where('user_id', Auth::id())->sum('gold');

        return view('theme::frontend.account.webinventory.index', [
            'account' => $account,
            'webGold' => $webGold
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

        $inventory = $webInventoryService->getInventoryFromAuth();

        return response()->json([
            'characterId' => $accountResponse['characterId'],
            'accountGoldFormatted' => $accountResponse['accountGoldFormatted'],
            'accountGold' => $accountResponse['accountGold'],
            'accountInventory' => $accountResponse['accountInventory'],
            'accountWebInventory' => $inventory['data']
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
                    'gold' => $goldResponse['goldArray'],
                    'goldWeb' => $goldResponse['goldWebArray']
                ], 200);
        }

        return response()->json([
            'error' => 'Something went wrong, please try again'
        ], 400);
    }

    /**
     * @param Request $request
     * @param WebInventoryService $webInventoryService
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function transferItemToWeb(
        Request $request,
        WebInventoryService $webInventoryService
    )
    {
        $validator = Validator::make($request->all(), [
            'serial64' => 'required|numeric|gt:0',
            'characterId' => 'required|int',
            '_token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 500);
        }

        $account = User::where('id', Auth::id())
            ->with('getTbUser.getShardUser')
            ->with('getTbUser.getShardUser.getCharOnlineOfflineLoggedIn')
            ->firstOrFail();

        // $characterId, $account, $serial64
        $transferResponse = $webInventoryService->transferItemToWeb(
            $request->get('characterId'),
            $account,
            $request->get('serial64')
        );

        if ($transferResponse['state'] === false) {
            return response()->json([
                'error' => $transferResponse['error']
            ], 400);
        }

        return response()->json([
            'data' => __('webinventory.submit-transfer-success')
        ], 200);
    }

    public function transferItemToGame(
        Request $request,
        WebInventoryService $webInventoryService
    )
    {
        $validator = Validator::make($request->all(), [
            'serial64' => 'required|numeric|gt:0',
            'characterId' => 'required|int',
            '_token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 500);
        }

        $account = User::where('id', Auth::id())
            ->with('getTbUser.getShardUser')
            ->with('getTbUser.getShardUser.getCharOnlineOfflineLoggedIn')
            ->firstOrFail();

        // $characterId, $account, $serial64
        $transferResponse = $webInventoryService->transferItemToGame(
            $request->get('characterId'),
            $account,
            $request->get('serial64')
        );

        if ($transferResponse['state'] === false) {
            return response()->json([
                'error' => $transferResponse['error']
            ], 400);
        }

        return response()->json([
            'data' => __('webinventory.submit-transfer-success-game')
        ], 200);
    }

    /**
     * @param WebInventoryService $webInventoryService
     * @return \Illuminate\Http\JsonResponse
     */
    public function inventory(
        WebInventoryService $webInventoryService
    )
    {
        $inventory = $webInventoryService->getInventoryFromAuth();

        if ($inventory['state'] === false) {
            return response()->json([
                'error' => 'Error'
            ], 400);
        }

        return response()->json([
            'inventory' => $inventory['data']
        ], 200);

    }
}
