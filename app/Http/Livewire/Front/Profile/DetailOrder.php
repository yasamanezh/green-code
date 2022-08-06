<?php

namespace App\Http\Livewire\Front\Profile;

use App\FrontModels\Order;
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
        $options=SiteOption::first();
        return view('livewire.front.profile.detail-order',compact('options'))->layout('layouts.front');
    }
}
