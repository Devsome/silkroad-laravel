<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use FrittenKeeZ\Vouchers\Facades\Vouchers;
use FrittenKeeZ\Vouchers\Models\Voucher;
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
        return view('backend.voucher.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function indexDatatables()
    {
        return DataTables::of(Voucher::query())->make(true);
    }

    public function addForm()
    {
        return view('backend.voucher.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'silk' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Vouchers::withMetadata([
            'silk' => $request->get('silk')
        ])->create(
            $request->get('amount')
        );

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Voucher::findOrFail($id)->delete();

        return back()->with('success', __('backend/notification.form-submit.success'));
    }
}
