<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\SiteOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Shetabit\Multipay\Invoice;

class Payment extends Controller
{
    public function index(Request $request)
    {
        $bank = Order::where('user_id', auth()->user()->id)->where('status', 1)->first();
        if (isset($bank->transactionId)) {
            $bank->update([
                'status' => 'NOK',
            ]);
            return redirect(route('Cart'));
        }
        if (!$bank) {
            return redirect(route('Cart'));
        }
        $siteOption = SiteOption::first();
        if ($bank->payment_type == 'offline') {
            if ($this->shipping()) {
                return redirect(route('callback'));
            } else {
                return redirect(route('Cart'));
            }
        } else {
            Config::set('payment.default', $bank->payment_type);
            if (\config('payment.default') == 'zarinpal') {

                Config::set('payment.drivers.zarinpal.merchantId', $siteOption->zarrinpall_merchent);
            }
            if (\config('payment.default') == 'sepehr') {

                Config::set('payment.drivers.sepehr.terminalId', $siteOption->saderat_terminal);
            }
            if (\config('payment.default') == 'sadad') {

                Config::set('payment.drivers.sadad.terminalId', $siteOption->meli_terminal);
                Config::set('payment.drivers.sadad.merchantId', $siteOption->meli_merchent);
            }
            $payConfig = config('payment');
            $payment = new \Shetabit\Multipay\Payment($payConfig);
            $amount = (float)$bank->prices;
            $invoice = (new Invoice)->amount($amount);
            $url = \Illuminate\Support\Facades\Request::url() . '/callback';
            return $payment->callbackUrl($url)->purchase($invoice, function ($driver, $transactionId) {
                $order = Order::where('user_id', auth()->user()->id)->where('status', 1)->first();
                $order->update([
                    'transactionId' => $transactionId
                ]);
            })->pay()->render();
        }

    }

    public function shipping()
    {
        $shipping = false;
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart) {
            $newPercent = 0;
            $product = \App\Models\Product::where('id', $cart->product_id)->first();
            $shipping = $product->shipping;
            if ($shipping == 'shipping') {
                $shipping = true;
            }
        }
        return $shipping;
    }
}
