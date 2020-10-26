<?php

namespace App\Http\Controllers\Frontend;

use App\DonationMethods;
use App\DonationStripes;
use App\Model\SRO\Account\SkSilk;
use App\Model\SRO\Account\SkSilkBuyList;
use App\Notification;
use App\PaypalInvoices;
use App\StripeInvoices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Omnipay\Omnipay;

class DonationsStripeController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function buy($id)
    {
        $stripe = DonationStripes::select(['id', 'price', 'name', 'silk'])
            ->findOrFail($id);

        $method = DonationMethods::select('currency')
            ->where('method', '=', 'stripe')
            ->where('active', '=', '1')
            ->firstOrFail();

        if (!config('stripe.public-key') || !config('stripe.secret-key')) {
            return back()->with('error', __('donations.notification.error.missing-keys'));
        }

        return view('theme::frontend.account.donations.stripe.buy', [
            'method' => $method,
            'stripe' => $stripe
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function buyPost(Request $request, $id)
    {
        $stripe = DonationStripes::select(['id', 'price', 'name', 'silk'])
            ->findOrFail($id);

        $method = DonationMethods::select('currency')
            ->where('method', '=', 'stripe')
            ->where('active', '=', '1')
            ->firstOrFail();

        $invoice = StripeInvoices::create([
            'user_id' => \Auth::id(),
            'payment_reference' => '',
            'name' => $stripe->name,
            'price' => $stripe->price,
            'silk' => $stripe->silk,
            'state' => PaypalInvoices::STATE_PENDING,
        ]);

        $paymentMethodId = $request->get('paymentMethodId');
        $response = $this->gateway()->purchase([
            'amount' => $stripe->price,
            'currency' => $method->currency,
            'description' => $stripe->name,
            'paymentMethod' => $paymentMethodId,
            'returnUrl' => route('donate-stripe-confirm'),
            'confirm' => true,
            'metadata' => [
                'order_id' => $invoice->id,
            ],
        ])->send();

        $invoice->payment_reference = $response->getPaymentIntentReference();
        $invoice->save();

        if ($response->isSuccessful()) {
            $this->addSilk($invoice, $request->ip());
            return redirect(route('donate-stripe-success'));
        } elseif ($response->isRedirect()) {
            $response->redirect();
        }

        return back()->with('error', 'Error checkout Stripe, try again');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function confirm(Request $request)
    {
        $invoice = StripeInvoices::where('payment_reference', $request->get('payment_intent'))
            ->firstOrFail();

        $response = $this->gateway()->confirm([
            'paymentIntentReference' => $request->get('payment_intent'),
            'returnUrl' => route('donate-stripe-confirm'),
        ])->send();

        if ($response->isSuccessful()) {
            $this->addSilk($invoice, $request->ip());
            return redirect(route('donate-stripe-success'));
        }

        return back()->with('error', 'Error checkout Stripe, try again');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function success()
    {
        return view('theme::frontend.account.donations.stripe.success');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function error()
    {
        return view('theme::frontend.account.donations.stripe.error');
    }

    /**
     * @param StripeInvoices $invoice
     * @param $ip
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    private function addSilk(StripeInvoices $invoice, $ip)
    {
        DB::beginTransaction();
        DB::connection('account')->beginTransaction();
        try {
            $userJid = \Auth::user()->jid;
            $skSilk = SkSilk::where('JID', $userJid)->first();

            $currentSilk = $skSilk->silk_own;
            $skSilk->increment('silk_own', $invoice->silk);

            SkSilkBuyList::create([
                'UserJID' => $userJid,
                'Silk_Type' => SkSilkBuyList::SilkTypeWeb,
                'Silk_Reason' => SkSilkBuyList::SilkReasonWeb,
                'Silk_Offset' => $currentSilk,
                'Silk_Remain' => $currentSilk + $invoice->silk,
                'ID' => $userJid,
                'BuyQuantity' => $invoice->silk,
                'OrderNumber' => $invoice->id,
                'AuthDate' => Carbon::now()->format('Y-m-d H:i:s'),
                'SlipPaper' => 'Stripe: ' . $invoice->payment_reference,
                'IP' => $ip,
                'RegDate' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            $invoice->state = StripeInvoices::STATE_PAID;
            $invoice->save();

            DB::commit();
            DB::connection('account')->commit();

            Notification::create([
                'user_id' => \Auth::id(),
                'key' => __('donations.notification.buy.notification', [
                    'amount' => $invoice->silk,
                ]),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            DB::connection('account')->rollback();
            return redirect()->route('donate-stripe-error')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * @return \Omnipay\Common\GatewayInterface
     */
    private function gateway()
    {
        $gateway = Omnipay::create('Stripe\PaymentIntents');
        $gateway->initialize([
            'apiKey' => config('stripe.secret-key'),
        ]);

        return $gateway;
    }
}
