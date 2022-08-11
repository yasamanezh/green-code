<?php

namespace App\Http\Livewire\Front\Payment;

use App\Jobs\DefaultNotification;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Notification;
use App\Models\Option;
use App\Models\Order;
use App\Models\OrderProdct;
use App\Models\Product;
use App\Models\SiteOption;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Livewire\Component;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Facade\Payment;

class Callback extends Component
{
    public $bank;
    public $receipt;
    public $exception;
    public $paymentType;

    public function mount(\Illuminate\Http\Request $request)
    {
        $siteOption = SiteOption::first();
        $this->bank = Order::where('user_id', auth()->user()->id)->get()->last();
        if ($this->bank->prices == 0) {
            $this->paymentType = 'free';
            $receipt = true;
            $exception = null;
            $this->updateTables($request, $this->bank);
        } else {
            $this->paymentType = 'online';
            Config::set('payment.default', $this->bank->payment_type);
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
            try {
                $amount = (float)$this->bank->prices;
                $receipt = Payment::amount(round($amount))->transactionId($this->bank->transactionId)->verify();
                $this->updateTables($request, $this->bank);
                $exception = null;
            } catch (InvalidPaymentException $exception) {
                $exception->getMessage();
                $receipt = null;
            }
            if (isset($receipt) || $exception->getCode() == '101') {
                $this->receipt = 1;
                $this->exception = 0;
            } else {
                $this->receipt = 0;
                $this->exception = 1;
                if ($this->bank->status != 200){
                    $this->CatchUpdateTb($this->bank);
                }
            }
        }
    }

    public function CatchUpdateTb($bank)
    {
        $bank->update([
            'status' => 'NOK',
            'processing' => 'wait'
        ]);

    }

    public function updateTables($request, $bank)
    {
        $user = auth()->user();
        DefaultNotification::dispatch($user, 'order');
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            DefaultNotification::dispatch($admin, 'order_admin');
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'order',
                'link' => $this->bank->id
            ]);
        }
        $request->session()->push('saveData', 'yes');
        if (isset($bank->copen_code) && ($bank->copen_price > 0)) {
            $discount = Discount::where('discount', 4)->where('code', $bank->copen_code)->first();
            if (isset($discount)) {
                if (isset($discount->count)) {
                    $count = $discount->count - 1;
                    $discount->count = $count;
                    $discount->update();
                }
            }
        }
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart) {
            $cart->delete();
        }
        $bank->update([
            'status' => 200,
            'processing' => 'complate'
        ]);

    }

    public function render()
    {
        return view('livewire.front.payment.callback')->layout('layouts.front');
    }
}
