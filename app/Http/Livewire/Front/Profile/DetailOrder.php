<?php

namespace App\Http\Livewire\Front\Profile;

use App\FrontModels\Order;

use App\Models\Product;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class DetailOrder extends Component
{
    public Order $order;

    public function isLicence($id)
    {
        $order=$this->order;

            $licence=$order->licence;
            if($licence){
                return true;
            }else{
                return false;
            }


    }

    public function title($id){
        $order= \App\Models\Order::findOrFail($id);
        if($order->title){
            return $order->title;
        }else{
            return Product::where('id',$order->product_id)->pluck('title')->first();
        }

    }
    public function mount(){
        SEOMeta::setTitle('جزئیات سفارش');
    }
    public function render()
    {
        $options=SiteOption::first();
        return view('livewire.front.profile.detail-order',compact('options'))->layout('layouts.front');
    }
}
