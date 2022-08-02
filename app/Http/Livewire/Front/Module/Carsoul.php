<?php

namespace App\Http\Livewire\Front\Module;

use App\FrontModels\Category;
use App\Models\ProductComment;
use Livewire\Component;
use App\Models\Carsoul as  CarsoulModels;
use App\Models\Product;
use App\Models\Discount;
use Hekmatinasser\Verta\Verta;
use Carbon\Carbon;
use App\Helper\Price;

class Carsoul extends Component
{
    public Carbon $carbon;
    public $carsouls;
    public $products;
    public $parent,$categories=[];
    public  $i=1;

    public function mount($carsoul){
            $this->carsouls=CarsoulModels::where('id',$carsoul)->first();

       //جدیدترین  //
        if($this->carsouls->type == 'latest'){
            $sort_by='id';
            $sort_type='DESC';
        }
        //پرفرش ترین //
        elseif ($this->carsouls->type =='bestseller'){
            $sort_by='countsell';
            $sort_type='DESC';
        }
        // ارزان ترین //
        elseif ($this->carsouls->type == 'sheep' ){
            $sort_by='price';
            $sort_type='ASC';
        }
        // گران ترین //
        elseif ($this->carsouls->type =='expensive'){
            $sort_by='price';
            $sort_type='DESC';
        }
        if($this->carsouls->category_id =='all'){
            if($this->carsouls->product_id == 'all'){
                $this->products=Product::orderBy($sort_by,$sort_type)->where('status', 1)->take($this->carsouls->count)->get();
            }
            elseif ($this->carsouls->product_id == 'special'){
                $products=Product::where('status', 1)->get();
                $ids=[];
                foreach($products as $product){
                    if($this->is_special($product->id) != false){
                        $ids[]=$product->id;
                    }
                }
                $this->products=Product::orderBy($sort_by,$sort_type)->where('status', 1)->whereIn('id',$ids)->take($this->carsouls->count)->get();

            }
            elseif ($this->carsouls->product_id == 'anbar'){

                $this->products=Product::orderBy($sort_by,$sort_type)->where('status', 1)->where('quantity','<>',0)->take($this->carsouls->count)->get();

            }
            elseif($this->carsouls->product_id == 'discount'){
                $ids=[];
                $products=Product::where('status', 1)->get();
                foreach($products as $product){
                    if($priceClass->AllProductDiscount() !=0){
                        $this->products=Product::orderBy($sort_by,$sort_type)->where('status', 1)->take($this->carsouls->count)->get();
                    }else{
                        if(isset($product->sell) && !empty($product->sell)){
                            $ids[]=$product->id;
                        }else{
                            if($priceClass->priceProdct($product->id) != 1){
                                $ids[]=$product->id;
                            }

                        }
                    }

                }
                $this->products=Product::orderBy($sort_by,$sort_type)->where('status', 1)->whereIn('id',$ids)->take($this->carsouls->count)->get();

            }
        }
        else{
            $category=Category::where('id',$this->carsouls->category_id)->first();
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

            if($this->carsouls->product_id == 'all'){
                $this->products=Product::orderBy($sort_by,$sort_type)->
                whereIn('category',$this->categories)->
                    where('status',1)->
                take($this->carsouls->count)->get();
            }
            elseif ($this->carsouls->product_id == 'special'){
                $ids=[];

                $products=Product:: whereIn('category',$this->categories)-> where('status',1)->get();
                foreach($products as $product){
                    if($this->is_special($product->id) != false){
                        array_push($ids,$product->id);
                    }
                }

                $this->products=Product::whereIn('id',$ids)->orderBy($sort_by,$sort_type)
                    ->where('status',1) ->  whereIn('category',$this->categories)
                    ->take($this->carsouls->count)->get();
            }
            elseif ($this->carsouls->product_id == 'anbar'){

                $this->products=Product::orderBy($sort_by,$sort_type)->where('quantity','<>',0)
                    ->where('status',1)
                    -> whereIn('category',$this->categories)
                     ->take($this->carsouls->count)->get();
            }
            elseif($this->carsouls->product_id == 'discount'){
                $ids=[];
                $products=Product:: whereIn('category',$this->categories)->where('status', 1)->get();
                foreach($products as $product){
                    if($priceClass->AllProductDiscount() !=0){
                        $this->products=Product::orderBy($sort_by,$sort_type)->where('status', 1)->take($this->carsouls->count)->get();
                    }else{
                        if(isset($product->sell) && !empty($product->sell)){
                            $ids[]=$product->id;
                        }else{
                            if($priceClass->priceProdct($product->id) != 1){
                                $ids[]=$product->id;
                            }

                        }
                    }

                }
                $this->products=Product:: whereIn('category',$this->categories)->orderBy($sort_by,$sort_type)->where('status', 1)->whereIn('id',$ids)->take($this->carsouls->count)->get();
            }
        }
    }

    public function calculateRate($id){
        $priceClass=new Price();
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

    public function is_special($id){
        $priceClass=new Price();
        // محاسبه  تاریخ انقضاء محصول شگفت انگیز
        $special=false;
        $discounts = Discount::where('status', 1)->where('discount', 1)->get();
        foreach ($discounts as $discount) {
            if ($priceClass->expire($discount) == false) {
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

    public function render()
    {
        return view('livewire.front.module.carsoul');
    }
}
