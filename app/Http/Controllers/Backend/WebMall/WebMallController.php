<?php

namespace App\Http\Controllers\Backend\WebMall;

use App\DataTables\Backend\WebMall\WebMallAdminLogsDataTable;
use App\DataTables\Backend\WebMall\WebMallDataTable;
use App\Helpers\WebMallHelper;
use App\Http\Controllers\Controller;
use App\Model\Backend\ItemWebMall;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class WebMallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param WebMallDataTable $dataTable
     * @return mixed
     */
    public function index(WebMallDataTable $dataTable)
    {
        return $dataTable->render('theme::backend.webmall.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return false|string
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'item_code' => ['required', 'exists:shard.dbo._RefObjCommon,CodeName128'],
            'item_quantity' => 'required|numeric',
            'silk_price' => 'required|numeric',
            'item_plus' => 'required|numeric',
        ]);

        $item = WebMallHelper::CreateItem($request->item_code, $request->item_quantity, $request->silk_price, $request->item_plus);
        WebMallHelper::createWebMallAdminLog($data, 'add');
        unset($item['tooltip']);

        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return false
     * @throws Exception
     */
    public function destroy($id): bool
    {
        $item = ItemWebMall::find($id);
        DB::beginTransaction();
        try {
            $item->delete();
            WebMallHelper::createWebMallAdminLog($item, 'delete');
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }

    /**
     * @param WebMallAdminLogsDataTable $dataTable
     * @return mixed
     */
    public function getLogs(WebMallAdminLogsDataTable $dataTable)
    {
        return $dataTable->render('theme::backend.webmall.log');
    }
}
