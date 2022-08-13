<?php

namespace App\Http\Livewire\Front\Profile;

use App\FrontModels\Order;

use App\Models\Product;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Hekmatinasser\Verta\Verta;
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

    public function issupport($id)
    {
        $order=$this->order;

            $support=$order->support;
            if($support){
                return true;
            }else{
                return false;
            }


    }
    public function support($id)
    {
        $order=$this->order;
       $support=$order->support;
            if($support){
                $start = new Verta($order->created_at);
                $end=$start->addDays($support);
                $now = verta();
                if( $now->diffDays($end) <=0){
                    return 'منقضی شده';
                }else{
                    return $now->diffDays($end).' '.'روز';
                }

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
