<?php

namespace App\Http\Livewire\Front\Cart;

use App\Http\Livewire\Admin\Product\Gallery\Product;
use App\Models\Cart;
use App\Models\CartOption;
use App\Models\Discount;
use App\Models\Option;
use App\Models\productOption;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{
    public $countProduct=[];
    public $cartDiscount= 0;
    public $total=0;
    public $price=[];

    public $shipping = false;



    public function isProductExit($id){
        $cart=Cart::find($id);
        if($cart) {
            $product = \App\Models\Product::where('status', 1)->where('id', $cart->product_id)->first();
            if ($product) {
                if ($product->type == 'phisical'){
                    if($product->quantity == 0){
                        return [2,'productNoExit'];
                    }else{
                    $ids = [];
                array_push($ids, $product->quantity);
                $min = min($ids);
                if ($cart->count > $min){
                    return [0, $min];
                }
                foreach ($cart->cartOptions as $optionProduct) {
                    $option = Option::where('product_id', $product->id)
                        ->where('option', $optionProduct->option)
                        ->where('value', $optionProduct->value)
                        ->first();
                    if ($option) {
                        if (isset($option->count) && !empty($option->count)) {
                            array_push($ids, $option->count);
                        }
                    } else {
                        return [4, $optionProduct->option . ' ' . $optionProduct->value];
                    }
                }

                if ($cart->count > $min) {
                    if(isset($optionProduct)){
                        return [0, $optionProduct->option . ' ' . $optionProduct->value . '' . $min];
                    }else{
                        return [0, $min];
                    }

                } else {
                    return [1, $min];
                }
            }}
        }else{
                return [2,'productNoExit'];
            }
        }
        return [12,12];
    }

    public function isSetRequired($id){
        $cart=Cart::find($id);
            $product = \App\Models\Product::where('status', 1)->where('id', $cart->product_id)->first();
            $proRequired=productOption::where('product_id',$product->id)
                ->where('required',1)->
                get();
            foreach ($proRequired as $value){
               $ifRequired=CartOption::where('cart_id',$cart->id)
                   ->where('option',$value->option)->first();
               if($ifRequired){
                   return false;
               }else{
                   return true;
               }
            }


    }

    public function isSetAllRequired(){
        $required=0;
        $carts =Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart){
            $product = \App\Models\Product::where('status', 1)->where('id', $cart->product_id)->first();
            if($product){
                $proRequired=productOption::where('product_id',$product->id)
                    ->where('required',1)->
                    get();
                foreach ($proRequired as $value){
                    $ifRequired=CartOption::where('cart_id',$cart->id)
                        ->where('option',$value->option)->first();
                    if(! $ifRequired){
                        if($required == 0){
                            $required=1;
                        }
                    }
                }
            }
        }
        return $required;
    }

    public function isDisable(){
        $disable=0;
        if($this->isSetAllRequired()){
            $disable=1;
        }
        $carts =Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart){
                $product= \App\Models\Product::where('status',1)->where('id',$cart->product_id)->first();
                if($product){
                    if ($product->type == 'phisical'){
                        if($product->quantity == 0){
                            if($disable==0){
                                $disable=1;
                            }
                        }
                        else{
                    $ids=[];
                    array_push($ids,$product->quantity);
                    foreach ($cart->cartOptions as $option) {
                        $option=Option::where('product_id',$product->id)
                            ->where('option',$option->option)
                            ->where('value',$option->value)
                            ->first();
                        if($option){
                            if(isset($option->count) && !empty($option->count)){
                                array_push($ids,$option->count);
                            }
                        }else{
                            if($disable==0){
                                $disable=1;
                            }

                        }

                    }
                    $min=min($ids);
                    if($cart->count > $min){
                        if($disable==0){
                            $disable=1;
                        }
                    }
                }}}else{
                    if($disable==0){
                        $disable=1;
                    }
                }
        }
        if($disable == 1){
            return true;
        }else{
            return false;
        }
    }

    public function removeFromCart($id){
        $data_info_id=Cart::where('id',$id)->first();
        $data_info_id->delete();
        $this->shipping=false;
        $carts=Cart::where('user_id',auth()->user()->id)->get();
        foreach ($carts as $cart) {
            $product = \App\Models\Product::where('id', $cart->product_id)->first();
            $shipping=$product->shipping;
            if($shipping =='shipping'){
                $this->shipping=true;
            }
        }
        return redirect(request()->header('Referer'));
    }

    public function validateAllCount()
    {
        $carts=Cart::get();
        foreach ($carts as $cart){
            $quantity = $cart->product()->pluck('quantity')->first();
            $min = $cart->product()->pluck('minimum')->first();
            $type = $cart->product()->pluck('type')->first();
            $productId = $cart->product()->pluck('id')->first();
            if (isset($quantity)) {
                $optioncount = $cart->product()->pluck('quantity')->first();
            } else {
                $optioncount = '';
            }

            $options=$cart->cartOptions()->get()->all();

            if(count($options) >=1){
                foreach ($options as $value) {
                    $option = Option::where('product_id', $productId)->
                    where('option', $value->option)->
                    where('value', $value->value)->first();

                    if (isset($option->count) && !empty($option->count)) {
                        if ($optioncount == '') {
                            $optioncount = $option->count;
                        } else {
                            $optioncount = $optioncount . ',' . $option->count;
                        }

                    }

                }
            }
            if($type =='phisical'){
                $max=min((explode(",",$optioncount)));
            }

            if(isset($max)){
                $this->validate([
                    "countProduct.$cart->id" => "numeric|min:$min|max:$max",
                ], [
                    'countProduct.*.numeric' => 'تعداد محصول باید عدد باشد.',
                    'countProduct.*.min' => " حداقل تعداد قابل سفارش" . $min .' عدد میباشد',
                    'countProduct.*.max' => " حداکثر تعداد قابل سفارش" . $max .' عدد میباشد',

                ]);
            }else{
                $this->validate([
                    "countProduct.$cart->id" => "numeric|min:$min",
                ], [
                    'countProduct.*.numeric' => 'تعداد محصول باید عدد باشد.',
                    'countProduct.*.min' => " حداقل تعداد قابل سفارش" . $min .' عدد میباشد',

                ]);
            }

            if($this->shipping){
                redirect(route('ShippingOrders'));

            }else{
                redirect(route('CartOrders'));
            }


        }

    }

    public function validateCount($id)
    {

        $this->validate([
            "countProduct.$id" => "numeric|integer|",
        ], [
            'countProduct.*.numeric' => 'تعداد محصول باید عدد باشد.',
            'countProduct.*.integer' => " تعداد باید به صورت عدد صحیح وارد شود."
        ]);
        $cart = Cart::with('cartOptions')->where('id', $id)->first();
        $quantity = $cart->product()->pluck('quantity')->first();
        $min = $cart->product()->pluck('minimum')->first();
        $type = $cart->product()->pluck('type')->first();
        $productId = $cart->product()->pluck('id')->first();
        if (isset($quantity)) {
            $optioncount = $cart->product()->pluck('quantity')->first();
        } else {
            $optioncount = '';
        }

        $options=$cart->cartOptions()->get()->all();

       if(count($options) >=1){

        foreach ($options as $value) {

            $option = Option::where('product_id', $productId)->
            where('option', $value->option)->
            where('value', $value->value)->first();

            if (isset($option->count) && !empty($option->count)) {
                if ($optioncount == '') {
                    $optioncount = $option->count;
                } else {
                    $optioncount = $optioncount . ',' . $option->count;
                }
            }

        }
       }
       if($type == 'phisical'){
           $max=min((explode(",",$optioncount)));
       }
       if(isset($max)){
           $this->validate([
               "countProduct.$id" => "numeric|integer|min:$min|max:$max",
           ], [
               'countProduct.*.numeric' => 'تعداد محصول باید عدد باشد.',
               'countProduct.*.min' => " حداقل تعداد قابل سفارش" . $min .' عدد میباشد',
               'countProduct.*.max' => " حداکثر تعداد قابل سفارش" . $max .' عدد میباشد',

           ]);
       }else{
           $this->validate([
               "countProduct.$id" => "numeric|integer|min:$min",
           ], [
               'countProduct.*.numeric' => 'تعداد محصول باید عدد باشد.',
               'countProduct.*.integer' => 'تعداد محصول باید عدد صحیح باشد.',
               'countProduct.*.min' => " حداقل تعداد قابل سفارش" . $min .' عدد میباشد',

           ]);
       }
        $cart->update([
            'count'=>(int)$this->countProduct[$id],

        ]);
    }

    public function CartDiscounts($total)
    {
        $TotalDiscount=0;
        $Discounts = Discount::where('discount', 5)->
        where('minimum','<=',(int)$total)->
        where('max','>=',(int)$total)->
        where('status', 1)->get();
        if($Discounts){
            foreach ($Discounts as $Discount){
                if ($Discount) {
                    if ($this->expire($Discount) == false) {
                        if ($total >= $Discount->minimum ){
                            if (isset($Discount->percent) && !empty($Discount->percent)) {
                                return ($Discount->percent / 100) * $this->total;
                            } elseif (isset($Discount->price) && !empty($Discount->price)) {
                                $TotalDiscount= $Discount->price;
                            }
                        }

                    }
                }
            }
        }
        return $TotalDiscount;
    }

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

    public function mount()
    {

        SEOMeta::setTitle('سبد خرید');
    }

    public function render(Request $request)
    {
        $carts =Cart::where('user_id', auth()->user()->id)->get();
        $total = 0;
        foreach ($carts as $cart) {
            $product = \App\Models\Product::where('id', $cart->product_id)->first();
            $shipping=$product->shipping;
            if($shipping =='shipping'){
                $this->shipping=true;
            }
            $this->countProduct[$cart->id] = $cart->count;
            $newPercent = 0;

            $product = \App\Models\Product::where('id', $cart->product_id)->first();
            foreach ($this->productDiscount() as $key1 => $value1) {
                if ($key1 == $product->id) {
                    $newPercent = $newPercent + $value1;
                }
            }
            if (isset($product->sell) && !empty($product->sell)) {
                $percents = $newPercent + $this->AllProductDiscount() + $product->sell;
            } else {
                $percents = $newPercent + $this->AllProductDiscount();
            }
            $price[$cart->id] = (1 - ($percents / 100)) * $product->price;

            foreach ($cart->cartOptions as $option) {

                $productOption = \App\Models\Option::where('value', $option->value)->
                where('option',$option->option)->
                where('product_id',$product->id)->
                first();
                if($productOption){
                    if (isset($productOption->price) && !empty($productOption->price)) {
                        if ($productOption->price_prefix == 1) {
                            $price[$cart->id] = $price[$cart->id] + $productOption->price;
                        } else {
                            if($price[$cart->id] !=0){
                                $price[$cart->id] = $price[$cart->id] - $productOption->price;
                            }

                        }
                    }
                }
            }
            $this->price[$cart->id] = $price[$cart->id];
            $total=$total+($price[$cart->id]*$cart->count);
            $this->total=$total;
        }
        $this->cartDiscount=$this->CartDiscounts($this->total);
        $session=$request->session()->get('warning');
        $options=SiteOption::first();
        return view('livewire.front.cart.index',compact('carts','options','session'))->layout('layouts.front');
    }
}
