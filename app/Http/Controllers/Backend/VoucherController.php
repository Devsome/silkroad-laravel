<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Library\Services\VouchersService;
use App\Voucher;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Validator;
use Yajra\DataTables\DataTables;

class VoucherController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('theme::backend.voucher.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function indexDatatables()
    {
        return DataTables::of(Voucher::query())->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addForm()
    {
        return view('theme::backend.voucher.create');
    }

    /**
     * @param Request $request
     * @param VouchersService $vouchersService
     * @return RedirectResponse
     */
    public function create(
        Request $request,
        VouchersService $vouchersService
    ) {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'silk' => 'required|numeric',
            'expired_at' => 'nullable|date|date_format:Y-m-d\TH:i'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $vouchersService->createVouchers(
            $request->get('silk'),
            $request->get('amount'),
            [],
            $request->get('expired_at') ?
                Carbon::createFromFormat('Y-m-d\TH:i', $request->get('expired_at')) :
                null
        );
        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Voucher::findOrFail($id)->delete();

        return back()->with('success', __('backend/notification.form-submit.success'));
    }
}
