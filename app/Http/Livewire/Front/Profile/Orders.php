<?php

namespace App\Http\Livewire\Front\Profile;

use App\Models\Order;
use App\Models\Product;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function title($id){
        $order=Order::findOrFail($id);
        if($order->title){
            return $order->title;
        }else{
            return Product::where('id',$order->product_id)->pluck('title')->first();
        }

    }
    public function mount()
    {
        SEOMeta::setTitle('سفارشات');
    }

    public function render()
    {

        $orders=Order::where('user_id',auth()->user()->id)->orderBy('id','Desc')->paginate(10);
        $options=SiteOption::first();
        return view('livewire.front.profile.orders',compact('orders','options'))->layout('layouts.front');
    }
}
