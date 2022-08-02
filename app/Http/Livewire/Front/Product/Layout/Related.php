<?php

namespace App\Http\Livewire\Front\Product\Layout;

use App\Models\Discount;
use App\Models\Product;
use Hekmatinasser\Verta\Verta;
use Livewire\Component;

class Related extends Component
{
    public $product;
    public $i=1;
    public function productDiscount()
    {
        // محاسبه تخفیف بر روی محصول
        $producriscunt = [];

        $discounts = Discount::where('status', 1)->where('discount', 1)->get();
        foreach ($discounts as $discount) {
            $productsId = array_keys($producriscunt);
            if ($this->expire($discount) == false) {
                foreach (explode(',', $discount->product_id) as $value) {
                    $exit=array_key_exists($value,$producriscunt);;
                    if($exit){
                        $producriscunt[$value] =$producriscunt[$value]+ $discount->percent;
                    }else{
                        $producriscunt[$value] = $discount->percent;
                    }
                }

            }

        }

        return $producriscunt;
    }

    public function AllProductDiscount()
    {

        // محاسبه تخفیف اعمال شده بر روی کل محصولات
        $discountsAllProducts = Discount::where('status', 1)->where('discount', 3)->get();
        $AllProductpercent = 0;
        foreach ($discountsAllProducts as $value) {
            if ($this->expire($value) == false) {
                $AllProductpercent = $AllProductpercent + $value->percent;
            }

        }
        return $AllProductpercent;
    }

    public function priceProdct($id)
    {
        $product= \App\FrontModels\Product::find($id);
        if(isset($product->sell)){
            $prcent=$product->sell;
        }else{
            $prcent=0;
        }
        foreach ($this->productDiscount() as $key=>$value){
            if($key == $id){
                $prcent=$prcent+$value;
            }
        }
        $prcent=$prcent+$this->AllProductDiscount();
        return (1-($prcent/100)) ;

    }

    public function expire($data)
    {
        $timeExpire = explode('/', $data->date_expire);
        $dateExpired = Verta::getGregorian($timeExpire[0], $timeExpire[1], $timeExpire[2]);
        $now = now();
        $expired = verta("$dateExpired[0]-$dateExpired[1]-$dateExpired[2] $data->time_expire");

        if (date_timestamp_get($expired) < date_timestamp_get($now)) {
            return true;
        } else {
            return false;
        }
    }

    public function mount($id)
    {;
        $this->product=Product::findOrFail($id);

    }

    public function render()
    {
        // محصولات مرتبط
        $prorelateds=[];
        $this->related = explode(',', $this->product->related);
        if($this->product->related){
            foreach ($this->related as $value) {
                $productValue = \App\FrontModels\Product::where('id', $value)->first();
                if($productValue){
                    array_push($prorelateds, $productValue);
                }

            }
        }

        return view('livewire.front.product.layout.related',compact('prorelateds'));
    }
}
