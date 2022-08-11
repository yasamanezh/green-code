<?php

namespace App\Http\Livewire\Front\Checkout;

use App\FrontModels\Order;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Product;
use App\Models\SiteOption;
use Hekmatinasser\Verta\Verta;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Index extends Component
{
    public Order $order;
    public $totalPrice,$cartDiscount,$payment_method;

    public function SaveOrder()
    {
        $this->validate([
            'payment_method' => ['required', Rule::in('sepehr', 'sadad', 'zarinpal')],
        ]);

        $order =$this->order;
        if ( $this->order) {
            $order->payment_type=$this->payment_method;
            $order->update();
            return redirect(route('payment'));
        }

    }

    public function mount($id)
    {
        $this->order=Order::where('order_number',$id)->first();
        $this->totalPrice=$this->order->product_price;
        $this->cartDiscount=$this->order->cart_discount_price;

    }
    public function render()
    {
        $siteOption=SiteOption::first();
        return view('livewire.front.checkout.index',compact('siteOption'))->layout('layouts.front');
    }
}
