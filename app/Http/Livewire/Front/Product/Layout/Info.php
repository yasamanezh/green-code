<?php

namespace App\Http\Livewire\Front\Product\Layout;

use App\Models\Cart;
use App\Models\Manufacturer;
use App\Models\NoProduct;
use App\Models\Option;
use App\Models\Product;
use App\Models\productOption;
use App\Helper\Price;
use Livewire\Component;

class Info extends Component
{
    public $product;
    public $count=1,$percent=0,$price,$optionPrice,$color,$option,$manufacturer;
    public $phone,$email;

    public function mount($id)
    {
     $this->product=Product::findOrFail($id);
        $this->count=$this->product->minimum;
        // قیمت محصول
        $this->price=$this->product->price;
        if(isset($this->product->sell) && !empty($this->product->sell)){
            $this->percent=$this->percent+$this->product->sell;
        }
        foreach(Price::productDiscount() as $key=>$value) {
            if($key == $this->product->id){
                $this->percent=$this->percent+$value;
            }
        }
        if($this->product->price ==0){
            $this->percent=0;
        }else{
            $this->percent=$this->percent+ Price::AllProductDiscount();
        }
        $this->slug = $this->product->slug;
        // برند
        $this->manufacturer=Manufacturer::where('id',$this->product->manufacturer)->first();

    }


    public function addToCart($id){

        if(! auth()->user()){
            return redirect(route('login'));
        }
        $min=$this->product->minimum;

        $this->validate([
            'count'=>"required|numeric|integer|min:$min",
        ]);

        $cart=Cart::where('product_id',$this->product->id)->where('user_id',auth()->user()->id)->first();
        if($cart){
            return redirect(route('CartOrders'));
        }

        $required=productOption::where('product_id',$this->product->id)->get();
        $colors=[];
        foreach ($required as $key=>$value) {

            if($value->required == 1) {
                $this->validate([
                    "color.$value->id" => 'required',
                ], [
                    'color.*.required' => 'انتخاب ' . $value->option . ' ضروری است ',
                ]);
                $countColor=Option::where('option',$value->option)->
                where('value',$this->color[$value->id])->
                where('product_id',$this->product->id)->
                first();
            }

            if(isset($this->color[$value->id])){
                    $colors[] = [
                        'option' => $value->option,
                        'value' => $this->color[$value->id],
                    ];
            }
        }

        $cart=new Cart();
        $cart->user_id=auth()->user()->id;
        $cart->product_id=$id;
        $cart->count=$this->count;

        $cart->save();
        if ($this->color) {
            if(count($colors) >=1){
                $cart->cartOptions()->createMany($colors);
            }
        }
        $this->count=$min;
        return redirect(route('CartOrders'));
    }

    public function changeSelectPrice($id,$optionId)
    {
        $productOption=productOption::findOrFail($optionId);

        $option=Option::where('value',$id)->
        where('option',$productOption->option)->
        where('product_id',$this->product->id)->
        first();
        if(isset($option->price) && !empty($option->price)){
            $prefix=$option->price_prefix;
            if($prefix == 1){
                $this->optionPrice[$optionId]='+'.$option->price;
            }elseif($prefix == 0){
                $this->optionPrice[$optionId]='-'.$option->price;
            }else{
                $this->optionPrice[$optionId]='+'.$option->price;
            }
        }else{
            $this->optionPrice[$optionId]=0;
        }


    }

    public function changePrie($id,$optionId)
    {
        $option=Option::find($id);

        if(isset($option->price) && !empty($option->price)){
            $prefix=$option->price_prefix;
            if($prefix == 1){
                $this->optionPrice[$optionId]='+'.$option->price;
            }elseif($prefix == 0){
                $this->optionPrice[$optionId]='-'.$option->price;
            }else{
                $this->optionPrice[$optionId]='+'.$option->price;
            }
        }else{
            $this->optionPrice[$optionId]=0;
        }


    }

    public function render()
    {
        $optionPrices=0;
        if(isset($this->optionPrice) && !empty($this->optionPrice)){
            foreach ($this->optionPrice as $price){
                $optionPrices=$optionPrices+(float)$price;
            }
        }

        $options=productOption::where('product_id',$this->product->id)->get();
        return view('livewire.front.product.layout.info',compact('options','optionPrices'));
    }
}
