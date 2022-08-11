<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class Add extends Component
{
    public $search,$order;
    public $title,$prices,$user,$discount;
    public function saveInfo()
    {
        $this->validate([
            'title'=>'required|string|min:2',
            'prices'=>'required|numeric',
            'discount'=>'nullable|numeric',
            'user'=>'required',
        ]);

        $order=new Order();
        $order->title=$this->title;
        $order->user_id=$this->user;
        $order->product_price=$this->prices;
        $order->cart_discount_price=$this->discount;
        $order->prices=$this->prices-$this->discount;
        $order->processing =='wait';
        $order->status ==1;
        $order->save();
        $order_number = date_timestamp_get($order->created_at) . $order->id;
        $order->update([
            'order_number' => $order_number
        ]);
        return redirect(route('admin.orders.index'));

    }
    public function render()
    {
        $users = User::get();
        return view('livewire.admin.order.add',compact('users'));
    }
}
