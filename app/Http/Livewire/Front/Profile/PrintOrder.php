<?php

namespace App\Http\Livewire\Front\Profile;

use App\Models\Order;
use App\Models\Product;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Hekmatinasser\Verta\Verta;
use Livewire\Component;

class PrintOrder extends Component
{
    public $order;
    public $user, $description, $processing;
    public $shipping;

    public function mount($order)
    {
        SEOMeta::setTitle('پرینت');
        $this->order = Order::where('order_number', $order)->first();
        $this->user = auth()->user();
    }

    public function title($id){
        $order=Order::findOrFail($id);
        if($order->title){
            return $order->title;
        }else{
            return Product::where('id',$order->product_id)->pluck('title')->first();
        }

    }
    public function render()
    {
        $siteOption = SiteOption::first();
        $counter = 1;
        $now = Verta::now();
        $totalcount = 0;
        return view('livewire.front.profile.print-order', compact('counter', 'siteOption', 'now', 'totalcount'))->layout('layouts.print');;
    }
}
