<?php

namespace App\Http\Controllers\Backend;

use App\DonationMethods;
use App\DonationPaypals;
use App\Http\Controllers\Controller;
use App\PaypalInvoices;
use Illuminate\Http\Request;
use Validator;
use Yajra\DataTables\DataTables;

class DonationsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $donationMethods = DonationMethods::all();

        return view('backend.donations.index', [
            'donationMethods' => $donationMethods
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logging()
    {
        return view('backend.donations.logging');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function loggingDatatables()
    {
        return DataTables::of(PaypalInvoices::where('state', '=', PaypalInvoices::STATE_PAID))
            ->make(true);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
        if($request->all() > 1) {
            // Setting all to 0
            DonationMethods::query()->update(['active' => false]);

            // Looping the request
            foreach($request->all() as $key => $data) {
                if($key === '_token') {
                    continue;
                }
                DonationMethods::where('id', '=', $key)
                    ->update(['active' => $data ? true : false]);
            }
        }

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function methodPaypal()
    {
        $method = DonationMethods::where('method', '=', 'paypal')
            ->firstOrFail();

        $paypal = DonationPaypals::all();

        return view('backend.donations.paypal', [
            'method' => $method,
            'paypal' => $paypal
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function methodPaypalDestroy(Request $request, $id)
    {
        DonationPaypals::findOrFail($id)->delete();

        return back()->with('success', __('backend/notification.form-submit.success'));
    }
}
