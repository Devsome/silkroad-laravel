<?php

namespace App\Http\Controllers\Frontend;

use App\DonationMethods;
use App\DonationPaypals;
use App\Http\Controllers\Controller;
use App\PaypalInvoices;
use Illuminate\Http\Request;

class DonationsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $donationMethods = DonationMethods::where('active', '=', 1)->get();
        return view('theme::frontend.account.donations', [
            'donationMethods' => $donationMethods
        ]);
    }

    /**
     * @param null $method
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showMethod($method = null) {
        $donationMethod = DonationMethods::where('method', '=', $method)
            ->firstOrFail();

        if($donationMethod->active !== 1) {
            return back()->with('error', trans('donations.paypal.disabled'));
        }

        if($method === 'paypal') {
            $paypal = DonationPaypals::all();
            $pendingInvoices = PaypalInvoices::where('user_id', '=', \Auth::id())
                ->where('state', '=', PaypalInvoices::STATE_PENDING)
                ->get();
            return view('theme::frontend.account.donations.paypal', [
                'method' => $donationMethod,
                'paypal' => $paypal,
                'invoices' => $pendingInvoices
            ]);
        }
        return back();
    }
}
