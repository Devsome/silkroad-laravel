<?php

namespace App\Http\Controllers\Backend;

use App\Library\Services\SRO\Shard\InventoryService;
use App\Model\SRO\Account\Notice;
use App\Model\SRO\Account\OnlineOfflineLog;
use App\Model\SRO\Account\Punishment;
use App\Model\SRO\Account\SkSilk;
use App\Model\SRO\Account\SmcLog;
use App\Model\SRO\Shard\Char;
use App\ServerGold;
use App\Todo;
use App\User;
use App\Voucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
     * @return Response
     */
    public function index(InventoryService $inventoryService)
    {
        return view('backend.index', [
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSoxCount(InventoryService $inventoryService, $filter = null)
    {
        $data = $inventoryService->getServerSoxFilter($filter);

        return view('backend.soxcount.show', [
            'filter' => $filter,
            'data' => $data['inventory'],
            'dataWeb' => $data['webInventory']
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function todoDelete($id, Request $request)
    {
        Todo::findOrFail($id)->update([
            'state' => Todo::TODO_DONE
        ]);

        return back()->with('success', trans('backend/notification.form-submit.todo-deleted'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function smclogIndex()
    {
        return view('backend.logging.smc');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function smclogDatatables()
    {
        return DataTables::of(SmcLog::query())->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blockedAccountsIndex()
    {
        return view('backend.logging.blocked');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function blockedAccountsDatatables()
    {
        return DataTables::of(Punishment::query())->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function worldmapIndex()
    {
        $onlineCharacters = OnlineOfflineLog::where('status', OnlineOfflineLog::STATUS_LOGGED_IN);

        return view('backend.worldmap.index', [
            'count' => $onlineCharacters->count(),
            'characters' => $onlineCharacters->with('getCharacter')->get()
        ]);
    }
}
