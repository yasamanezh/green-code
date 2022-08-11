<?php

namespace App\Http\Livewire\Admin\Order;

use App\Jobs\DefaultNotification;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\OrderProdct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Detail extends Component
{
    public $order;
    public $licence,$support;
    public $user, $description, $processing;
    public $shipping;
    public $i = 0, $inputProducts = [], $title = [], $price = [], $count = [];


    public function removeProduct($i)
    {
        unset($this->inputProducts[$i]);
        unset($this->title[$i]);
        unset($this->price[$i]);
        unset($this->count[$i]);

    }

    public function mount($detail)
    {

        $orderProducts = OrderProdct::where('order_id', $detail)->get()->all();

        foreach ($orderProducts as $orderProduct) {
            $i = $this->i;
            $i = $i + 1;
            array_push($this->inputProducts, $i);
            array_push($this->price, $orderProduct->price);
            array_push($this->count, $orderProduct->count);
            array_push($this->title, $orderProduct->count);

        }
        $this->order = Order::find($detail);
        $this->user = auth()->user();
        $this->licence=$this->order->licence;

        $this->support=$this->order->support;

    }

    public function deleteProduct($id)
    {
        if (Gate::allows('delete_order')) {
            $product = OrderProdct::find($id);
            $productPrice = ($product->price) * ($product->count);
            $totalPrice = ($this->order->prices) - ($productPrice);
            $Price = ($this->order->product_price) - ($productPrice);
            $this->order->update([
                'prices' => $totalPrice,
                'product_price' => $Price
            ]);
            $product->delete();
            $this->emit('toast', 'success', ' محصول با موفقیت از سفارش حذف شد.');
            return redirect(request()->header('Referer'));
        } else {
            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }

    }
    public function title($id){
        $order=Order::findOrFail($id);
        if($order->title){
            return $order->title;
        }else{
            return Product::where('id',$order->product_id)->pluck('title')->first();
        }

    }


    public function saveInfo()
    {

        if (Gate::allows('edit_order')) {

            $this->validate([
                'processing' => 'required'
            ]);
            $this->order->update([
                'processing' => $this->processing
            ]);
            $history = new OrderHistory();
            $history->order_id = $this->order->id;
            $history->description = $this->description;
            $history->history = $this->processing;
            $history->save();

            if ($this->processing == 'post' || $this->processing == 'delivered') {
                if ($this->processing == 'post') {
                    $user = User::where('id', $this->order->user_id)->first();
                    DefaultNotification::dispatch($user, 'post');

                } elseif ($this->processing == 'delivered') {
                    $user = User::where('id', $this->order->user_id)->first();
                    DefaultNotification::dispatch($user, 'complate');

                }

            }
            $this->emit('toast', 'success', ' تاریخچه  با موفقیت افزوده شد.');
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function support()
    {
        $order=$this->order;
        $order->support=$this->support;
        $this->order->update();
        $this->emit('toast', 'success', 'پشتیبانی با موفقیت به روز رسانی شد.');

    }
    public function license()
    {
        $order=$this->order;
        $order->licence=$this->licence;
        $order->update();
        $this->emit('toast', 'success', 'لایسنس با موفقیت به روز رسانی شد.');
    }

    public function render()
    {
        $products = OrderProdct::where('id', $this->order->order_id)->get();


        return view('livewire.admin.order.detail', compact('products'));
    }
}
