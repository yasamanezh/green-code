<?php

namespace App\Http\Livewire\Front\Shipping;

use App\Models\Address;
use App\Models\Cart;
use App\Models\CartOption;
use App\Models\Country;
use App\Models\Discount;
use App\Models\Option;
use App\Models\Order;
use App\Models\OrderProdct;
use App\Models\productOption;
use App\Models\SiteOption;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Hekmatinasser\Verta\Verta;
use Livewire\Component;

class Index extends Component
{
    public $user, $totalPrice;
    public $state, $code_posti, $city, $address, $mobile, $lname, $name;
    public  $carts;
    public $addres;
    public $description;

    public $editAddress, $AddresID;
    public $siteOption;
    public $cartDiscount = 0;
    public $shipping = false;
    public $selectGroup,$selected;
    public $selected2 = [];
    public $selectGroup2;
    public $showEditModal = false;

    public function createAddress()
    {
        $this->validate([
            'name' => 'required|string|min:2',
            'mobile' => 'required|digits:11',
            'code_posti' => 'required|digits:10',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);
        $addres = new Address();
        $addres->user_id = auth()->user()->id;
        $addres->name = $this->name;
        $addres->mobile = $this->mobile;
        $addres->code_posti = $this->code_posti;
        $addres->state = $this->state;
        $addres->city = $this->city;
        $addres->address = $this->address;
        $addres->save();
        $this->name='';
        $this->mobile='';
        $this->code_posti='';
        $this->state='';
        $this->city='';
        $this->address='';

        $this->dispatchBrowserEvent('hide-form');
        $this->emit('toast', 'success', 'آدرس جدید با موفقیعت ایجاد شد.');
        return back();

    }

    public function updateAddress()
    {
        $addres = Address::find($this->AddresID);

        $this->validate([
            'name' => 'required|string|min:2',
            'mobile' => 'required|digits:11',
            'code_posti' => 'required|digits:10',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        $addres->update([
            'name' => $this->name,
            'mobile' => $this->mobile,
            'code_posti' => $this->code_posti,
            'state' => $this->state,
            'city' => $this->city,
            'address' => $this->address,
        ]);
        $this->name='';
        $this->mobile='';
        $this->code_posti='';
        $this->state='';
        $this->city='';
        $this->address='';

        $this->dispatchBrowserEvent('hide-form');

        $this->emit('toast', 'success', 'آدرس با موفقیعت ویرایش شد.');
        return back();
    }

    public function editAdress($id)
    {
        $editAddress = Address::find($id);
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form');
        $this->address = $editAddress->address;
        $this->state = $editAddress->state;
        $this->city = $editAddress->city;
        $this->name = $editAddress->name;
        $this->lname = $editAddress->lname;
        $this->mobile = $editAddress->mobile;
        $this->code_posti = $editAddress->code_posti;
        $this->AddresID = $id;


    }

    public function AddAddress()
    {

        $this->dispatchBrowserEvent('show-form');

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

    public function isDisable(){
        $disable=0;
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

    public function option($order)
    {
        // محاسبه گزینه های محصولات در سبد خرید
        $carts = Cart::where('user_id', auth()->user()->id)->get();

        foreach ($carts as $cart) {
            $products = $cart->product;
            $newPercent = 0;
            foreach ($this->productDiscount() as $key => $value) {
                if ($key == $products->id) {
                    $newPercent = $newPercent + $value;
                } else {
                    $newPercent = $newPercent;
                }
            }

            if (isset($products->sell) && !empty($products->sell)) {
                $percents = $newPercent + $this->AllProductDiscount() + $products->sell;
            } else {
                $percents = $newPercent + $this->AllProductDiscount();
            }

            $price = (1 - ($percents / 100)) * $products->price;

            $optionsave = '';
            $optionId = '';
            foreach ($cart->cartOptions as $option) {
                $productOption = \App\Models\Option::where('product_id', $products->id)->
                where('value', $option->value)->
                where('option',$option->option)->
                first();
                if($optionId == ''){
                    $optionId =$productOption->id;
                }else{
                    $optionId = $optionId . ',' . $productOption->id;
                }
                if($optionsave == ''){
                    $optionsave =$productOption->value;

                }else{
                    $optionsave = $optionsave . ',' . $productOption->value;

                }

                if (isset($productOption->price) && !empty($productOption->price)) {
                    if ($productOption->price_prefix == 1) {
                        $price = $price + $productOption->price;

                    } else {
                        $price = $price - $productOption->price;
                    }
                }
            }
            $product = new OrderProdct();
            $product->order_id = $order->id;
            $product->title = $cart->product->title;
            $product->product_id = $cart->product->id;
            $product->price = $price;
            $product->options = $optionsave;
            $product->options_id = $optionId;
            $product->count = $cart->count;
            $product->total = ($price) * $cart->count;
            $product->save();
        }

    }

    public function validateAllCount()
    {
        $carts=Cart::get();
        foreach ($carts as $cart){
            $quantity = $cart->product()->pluck('quantity')->first();
            $productId = $cart->product()->pluck('id')->first();
            if (isset($quantity)) {
                $optioncount = $cart->product()->pluck('quantity')->first();
            } else {
                $optioncount = '';
            }

            $options=$cart->cartOptions()->get()->all();

            if(count($options) >=1){

                foreach ($options as $value) {

                    $option = Option::where('product_id', $productId)->where('option', $value->option)->where('value', $value->value)->first();

                    if (isset($option->count) && !empty($option->count)) {
                        if ($optioncount == '') {
                            $optioncount = $option->count;
                        } else {
                            $optioncount = $optioncount . ',' . $option->count;
                        }
                    }

                }
            }
            $min = $cart->product()->pluck('minimum')->first();
            $type = $cart->product()->pluck('type')->first();

            if($type =='phisical'){
                $max=min((explode(",",$optioncount)));
                $msg='تعداد سفارش شما بیش از موجودی انبار است.';
                if($cart->count >$max ){
                    redirect(route('Cart'))->with('warning',$msg);
                }
            }
            if($cart->count < $min){
                $msg='تعداد سفارش شما کمتر از حداقل محصول قابل سفارش است.';
                redirect(route('Cart'))->with('warning',$msg);
            }

        }
    }

    public function saveOrder()
    {
        //اعتبار سنجی
        $this->validate([
            'addres' => 'required',
        ]);

        // محاسبه قیمت کل
        $total = $this->totalPrice -  $this->cartDiscount;


        //  آدرس
        if($this->shipping) {
            $addresses = Address::where('id', $this->addres)->first();
            $state = $addresses->state;
            $city = $addresses->city;
            $address = $addresses->address;
            $code_posti = $addresses->code_posti;
            $mobile = $addresses->mobile;
            $name = $addresses->name;
        }else{
            $state = null;
            $city = null;
            $address = null;
            $code_posti = null;
            $mobile = null;
            $name = null;
        }

        // ایجاد و یا ویرایش سفارش
        $order = Order::where('user_id', auth()->user()->id)->where('status', 1)->first();

        if ($order) {
            // ویرایش سفارش
            $order->product_price = $this->totalPrice;
            $order->update([
                'product_price' => $this->totalPrice,
                'cart_discount_price' => $this->cartDiscount,
                'prices' => $total,

                'status' => 1,
                'address' => $address,
                'code_posti' => $code_posti,
                'city' => $city,
                'zone' => $state,
                'name' => $name,
                'mobile' => $mobile,
                'description' => $this->description,


            ]);
            $productOrders = OrderProdct::where('order_id', $order->id)->get();
            foreach ($productOrders as $ProductOrder) {
                $ProductOrder->delete();
            }
            // محاسبه و ذخیره گزینه های هر محصول
            $this->Option($order);

        }
        else {

            $newOrder = new Order();
            $newOrder->address = $address;
            $newOrder->city = $city;
            $newOrder->zone = $state;

            $newOrder->cart_discount_price = $this->cartDiscount;
            $newOrder->name = $name;
            $newOrder->product_price = $this->totalPrice;
            $newOrder->prices = ($this->totalPrice);
            $newOrder->code_posti = $code_posti;
            $newOrder->mobile = $mobile;
            $newOrder->description = $this->description;

            $newOrder->processing = 'wait';
            $newOrder->user_id = auth()->user()->id;
            $newOrder->status = 1;
            $newOrder->save();
            $order_number=date_timestamp_get($newOrder->created_at).$newOrder->id;
            $newOrder->update([
                'order_number'=>$order_number
            ]);

            // محاسبه و ذخیره گزینه های هر محصول
            $this->Option($newOrder);

        }

        return $this->redirect(route('CartOrders'));

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

    public function mount()
    {
        SEOMeta::setTitle('تسویه حساب');
        if($this->isDisable()){
            return redirect(route('Cart'));

        }
        if($this->isSetAllRequired()){
            return redirect(route('Cart'));
        }
        $this->validateAllCount();
        $this->siteOption = SiteOption::first();
        $this->totalPrice = 0;
        $this->user = User::with('Addresses')->find(auth()->user()->id);
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        $this->carts = $carts;
        // محاسبه قیمت محصولات سبد خرید
        foreach ($carts as $cart) {
            $newPercent = 0;
            $product = \App\Models\Product::where('id', $cart->product_id)->first();
            $shipping=$product->shipping;
            if($shipping =='shipping'){
                $this->shipping=true;
            }
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
            $price = (1 - ($percents / 100)) * $product->price;
            foreach ($cart->cartOptions as $option) {

                $productOption = \App\Models\Option::where('product_id', $product->id)->
                where('value', $option->value)->
                where('option',$option->option)->
                first();
                if (isset($productOption->price) && !empty($productOption->price)) {
                    if ($productOption->price_prefix == 1) {
                        $price = $price + $productOption->price;
                    } else {
                        if($price !=0){
                            $price =$price - $productOption->price;
                        }

                    }
                }
            }
            $this->totalPrice = $this->totalPrice + $price * ($cart->count);
        }
        // محاسبه تخفیف سبد خرید

        $this->cartDiscount=$this->CartDiscounts($this->totalPrice);
    }

    public function render()
    {
        $total = $this->totalPrice;
        $addresses = Address::where('user_id', auth()->user()->id)->get();
        $countries = Country::all();
        $options=SiteOption::first();
        return view('livewire.front.shipping.index', compact('addresses','options', 'total','countries'))->layout('layouts.front');
    }
}
