<?php

namespace App\Http\Livewire\Front\Module;

use App\FrontModels\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Proposal;
use Hekmatinasser\Verta\Verta;
use Livewire\Component;
use App\Helper\Price;
class Spesial extends Component
{
    public $spesials;
    public $products;
    public $parent,$categories=[];
    public $i=1;

    public function is_special($id){
        // محاسبه  تاریخ انقضاء محصول شگفت انگیز
        $special=false;
        $discounts = Discount::where('status', 1)->where('discount', 1)->get();
        foreach ($discounts as $discount) {
            if (Price::expire($discount) == false) {
                foreach (explode(',', $discount->product_id) as $value) {
                    if($value == $id ){
                        if($discount->special ==1){
                            $timeExpire = explode('/', $discount->date_expire);
                            $dateExpired = Verta::getGregorian($timeExpire[0], $timeExpire[1], $timeExpire[2]);
                            $expired = ("$dateExpired[1]/$dateExpired[2]/$dateExpired[0] $discount->time_expire ");
                            $special= $expired;
                        }
                    }
                }
            }
        }

        return $special;
    }

    public function mount($spesial){
        $ids=[];
       $this->spesials=Proposal::where('id',$spesial)->first();
        if($this->spesials->category_id =='all'){
              $products=Product::where('status', 1)->get();
              foreach($products as $product){
                  if($this->is_special($product->id) != false){
                      $ids[]=$product->id;
                  }
              }
            $this->products=Product::whereIn('id',$ids)->take($this->spesials->count)->get();
        }else{
            $category=Category::where('id',$this->spesials->category_id)->first();
            $this->categories[1]=$category->id;
            if(isset($category->parent) && $category->parent !=0 ){
                $this->sub=Category::where('id',$category->parent)->first();

                if(isset($this->sub)){
                    if(isset($this->sub->parent) &&  $this->sub->parent !=0){
                        $this->child=Category::where('id',$this->sub->parent)->first();

                    }
                }
            }
            $AllCategory=Category::where('status',1)->where('parent',$category->id)->get();
            foreach ($AllCategory as $cat){
                array_push($this->categories,$cat->id);
                $AllParent=Category::where('status',1)->where('parent',$cat->id)->get();
                foreach ($AllParent as $parent){
                    array_push($this->categories,$parent->id);
                }
            }



            $products=Product::
            whereIn('category',$this->categories )->
            where('status',1)->
            get();
            foreach($products as $product){
                if($this->is_special($product->id) != false){
                    array_push($ids,$product->id);
                  }
            }
            $this->products=Product::whereIn('id',$ids)->take($this->spesials->count)->get();
        }
    }

    public function render()
    {

        return view('livewire.front.module.spesial');
    }
}
