<?php

namespace App\Http\Controllers\Backend;

use App\Http\Library\Services\SRO\Shard\InventoryService;

use App\Http\Model\SRO\Account\Notice;
use App\Http\Model\SRO\Account\OnlineOfflineLog;
use App\Http\Model\SRO\Account\Punishment;
use App\Http\Model\SRO\Account\SkSilk;
use App\Http\Model\SRO\Account\SmcLog;
use App\Http\Model\SRO\Shard\Char;
use App\ServerGold;
use App\Todo;
use App\User;
use App\Voucher;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class BackendController
 * @package App\Http\Controllers\Backend
 */
class BackendController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param InventoryService $inventoryService
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Response
     */
    public function index(InventoryService $inventoryService)
    {
        if (ServerGold::all()->count() === 0) {
            ServerGold::create([
                'gold' => 0
            ]);
        }
        return view('theme::backend.index', [
            'userCount' => User::count(),
            'playerCount' => Char::count(),
            'silkCount' => SkSilk::all()->sum('silk_own'),
            'notices' => Notice::orderBy('ID', 'DESC')->take(5)->get(),
            'chars' => Char::orderBy('CharID', 'DESC')->take(5)->get(),
            'vouchersCount' => Voucher::whereNull('redeemed_at')
                ->whereNull('expires_at')
                ->orWhere('expires_at', '>=', Carbon::now())->count(),
            'webGold' => ServerGold::first(),
            'serverGold' => Char::all()->sum('RemainGold'),
            'soxCount' => $inventoryService->getServerSoxCount(),
            'todos' => Todo::with('getUserName')
                ->where('state', Todo::TODO_PROGRESS)->get()
        ]);
    }

    /**
     * @param null $filter
     * @param InventoryService $inventoryService
     * @return array|string
     */
    public function soxCountFilter(InventoryService $inventoryService, $filter = null)
    {
        return response()->json([
            'success' => true,
            'counts' => $inventoryService->getServerSoxCount($filter)
        ], 200);
    }

    /**
     * @param null $filter
     * @param InventoryService $inventoryService
     * @return Factory|View
     */
    public function showSoxCount(InventoryService $inventoryService, $filter = null)
    {
        $data = $inventoryService->getServerSoxFilter($filter);

        return view('theme::backend.soxcount.show', [
            'filter' => $filter,
            'data' => $data['inventory'],
            'dataWeb' => $data['webInventory']
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function todoAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '_token' => 'required',
            'body' => 'required|min:5|max:150',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator);
        }

        Todo::create([
            'user_id' => Auth::user()->id,
            'body' => $request->get('body')
        ]);

        return response()->json([
            'state' => 'successfully',
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function todoDelete($id, Request $request)
    {
        Todo::findOrFail($id)->update([
            'state' => Todo::TODO_DONE
        ]);

        return back()->with('success', trans('backend/notification.form-submit.todo-deleted'));
    }

    /**
     * @return Factory|View
     */
    public function smclogIndex()
    {
        return view('theme::backend.logging.smc');
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function smclogDatatables()
    {
        return DataTables::of(SmcLog::query())->make(true);
    }

    /**
     * @return Factory|View
     */
    public function blockedAccountsIndex()
    {
        return view('theme::backend.logging.blocked');
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function blockedAccountsDatatables()
    {
        return DataTables::of(Punishment::query())->make(true);
    }

    /**
     * @return Factory|View
     */
    public function worldmapIndex()
    {
        $onlineCharacters = OnlineOfflineLog::where('status', OnlineOfflineLog::STATUS_LOGGED_IN);

        return view('theme::backend.worldmap.index', [
            'count' => $onlineCharacters->count(),
            'characters' => $onlineCharacters->with('getCharacter')->get()
        ]);
    }
}
