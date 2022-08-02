<?php

namespace App\Http\Livewire\Front\Module;

use App\FrontModels\Product;
use App\Models\ProductComment;
use Livewire\Component;

class InstantOffer extends Component
{
    public function calculateRate($id){
        $stars=ProductComment::where('product_id',$id)->get();
        $count=count($stars);
        $rate=0;
        if($count > 0){
            foreach ($stars as $star){
                if($star->star != NULL){
                    $rate=$rate+$star->star;
                }
            }
            return (round($rate/$count));
            return ((($rate/$count)*100)/5);
        }
        return 0;
    }

    public function render()
    {
        $products=Product::where('status',1)->get();
        return view('livewire.front.module.instant-offer',compact('products'));
    }
}
