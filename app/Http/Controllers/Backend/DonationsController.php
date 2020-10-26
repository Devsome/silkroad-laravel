<?php

namespace App\Http\Controllers\Backend;

use App\DonationMethods;
use App\DonationPaypals;
use App\Http\Controllers\Controller;
use App\PaypalInvoices;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Validator;
use Yajra\DataTables\DataTables;

class DonationsController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $donationMethods = DonationMethods::all();

        return view('theme::backend.donations.index', [
            'donationMethods' => $donationMethods
        ]);
    }

    /**
     * @return Factory|View
     */
    public function logging()
    {
        return view('theme::backend.donations.logging');
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function loggingDatatables()
    {
        return DataTables::of(PaypalInvoices::where('state', '=', PaypalInvoices::STATE_PAID))
            ->make(true);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateMethods(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '_token' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator);
        }

        // More then the _token
        if ($request->all() > 1) {
            // Setting all to 0
            DonationMethods::query()->update(['active' => false]);

            // Looping the request
            foreach ($request->all() as $key => $data) {
                if ($key === '_token') {
                    continue;
                }
                DonationMethods::where('id', '=', $key)
                    ->update(['active' => $data ? true : false]);
            }
        }

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @return Factory|View
     */
    public function methodPaypal()
    {
        $method = DonationMethods::where('method', '=', 'paypal')
            ->firstOrFail();

        $paypal = DonationPaypals::all();

        return view('theme::backend.donations.paypal', [
            'method' => $method,
            'paypal' => $paypal
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function methodPaypalAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '_token' => 'required',
            'name' => 'required|max:50',
            'description' => 'required|max:250',
            'price' => 'required|numeric|min:0|not_in:0',
            'silk' => 'required|integer|min:0|not_in:0',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        DonationPaypals::create($request->all());

        return back()->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function methodPaypalDestroy(Request $request, $id)
    {
        DonationPaypals::findOrFail($id)->delete();

        return back()->with('success', __('backend/notification.form-submit.success'));
    }
}
