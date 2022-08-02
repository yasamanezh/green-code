<?php

namespace App\Http\Livewire\Front\Profile;

use App\FrontModels\Order;
use App\Models\OrderHistory;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class DetailOrder extends Component
{
    public Order $order;
    public function mount(){
        SEOMeta::setTitle('جزئیات سفارش');
    }
    public function render()
    {
        $history=OrderHistory::orderBy('id','DESC')->where('order_id',$this->order->id)->first();
        $options=SiteOption::first();
        return view('livewire.front.profile.detail-order',compact('history','options'))->layout('layouts.front');
    }
}
