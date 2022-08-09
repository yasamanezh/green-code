<?php

namespace App\Http\Livewire\Front\Order;


use App\Models\Cart;
use App\Models\CartOption;

use App\Models\Discount;
use App\Models\Option;
use App\Models\Order;
use App\Models\OrderProdct;
use App\Models\productOption;
use App\Models\SiteOption;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Hekmatinasser\Verta\Verta;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Index extends Component
{
    public $user, $totalPrice;
   public $copen, $code = 0, $carts;
    public  $payment_method;
    public $siteOption;
    public $cartDiscount = 0;

    public function AddCopen()
    {

        $copen = Discount::where('discount', 4)->where('code', $this->copen)->where('status', 1)->first();
        if ($copen && $copen->count >= 1) {

            if ($this->expire($copen) == true) {
                $this->emit('toast', 'warning', 'کد وارد شده منقضی شده است.');

            } else {
                if ($copen->percent) {
                    $this->code = (($copen->percent / 100) * $this->totalPrice);

                } elseif ($copen->price) {
                    $this->code = $copen->price;
                }
            }
        } else {
            $this->emit('toast', 'warning', 'کد وارد شده اشتباه است.');
        }


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


    public function SaveOrder()
    {
        $this->validate([
            'payment_method' => ['required', Rule::in('sepehr', 'sadad', 'zarinpal', 'offline')],
        ]);
        $total = $this->totalPrice - $this->code - $this->cartDiscount;
        // ایجاد و یا ویرایش سفارش
        $order = Order::where('user_id', auth()->user()->id)->where('status', 1)->first();
        if ($order) {
            // ویرایش سفارش
            $order->product_price = $this->totalPrice;
            $order->update([
                'product_price' => $this->totalPrice,
                'cart_discount_price' => $this->cartDiscount,
                'prices' => $total,
                'copen_code' => $this->copen,
                'copen_price' => $this->code,
                'status' => 1,
                'payment_type' => $this->payment_method,
            ]);
            $productOrders = OrderProdct::where('order_id', $order->id)->get();
            foreach ($productOrders as $ProductOrder) {
                $ProductOrder->delete();
            }
            // محاسبه و ذخیره گزینه های هر محصول
            $this->Option($order);
        } else {
            $newOrder = new Order();
            $newOrder->cart_discount_price = $this->cartDiscount;
            $newOrder->product_price = $this->totalPrice;
            $newOrder->prices = $total;
            $newOrder->copen_code = $this->copen;
            $newOrder->copen_price = $this->code;
            $newOrder->payment_type = $this->payment_method;
            $newOrder->processing = 'wait';
            $newOrder->user_id = auth()->user()->id;
            $newOrder->status = 1;
            $newOrder->save();
            $order_number = date_timestamp_get($newOrder->created_at) . $newOrder->id;
            $newOrder->update([
                'order_number' => $order_number
            ]);
            // محاسبه و ذخیره گزینه های هر محصول
            $this->Option($newOrder);
        }
        return redirect(route('payment'));
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

            foreach ($cart->cartOptions as $option) {
                $productOption = \App\Models\Option::where('value', $option->value)->
                where('option', $option->option)->
                where('product_id', $products->id)->
                first();
                if ($productOption){

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
                $product->product_id = $cart->product->id;
                $product->title = $option->value;
                $product->option = $option->option;
                $product->save();
            }

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
                    $exit = array_key_exists($value, $producriscunt);
                    if ($exit) {
                        $producriscunt[$value] = $producriscunt[$value] + $discount->percent;
                    } else {
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

    public function mount()
    {
        SEOMeta::setTitle('پرداخت');

        if ($this->isSetAllRequired()) {
           // return redirect(route('Cart'));
        }

        $this->siteOption = SiteOption::first();
        $this->totalPrice = 0;
        $this->user = User::find(auth()->user()->id);
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        $this->carts = $carts;
        // محاسبه قیمت محصولات سبد خرید
        $weight_cart = 0;
        foreach ($carts as $cart) {
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
            $price = (1 - ($percents / 100)) * $product->price;
            foreach ($cart->cartOptions as $option) {

                $productOption = \App\Models\Option::where('product_id', $cart->product_id)->
                where('value', $option->value)->
                where('option', $option->option)->
                first();
                if (isset($productOption->price) && !empty($productOption->price)) {
                    if ($productOption->price_prefix == 1) {
                        $price = $price + $productOption->price;
                    } else {
                        if ($price != 0) {
                            $price = $price - $productOption->price;
                        }

                    }
                }
            }
            $this->totalPrice = $this->totalPrice + $price * ($cart->count);
        }
        // محاسبه تخفیف سبد خرید
        $this->cartDiscount = $this->CartDiscounts($this->totalPrice);
    }

    public function isSetAllRequired()
    {
        $required = 0;
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart) {
            $product = \App\Models\Product::where('status', 1)->where('id', $cart->product_id)->first();
            if ($product) {
                $proRequired = productOption::where('product_id', $product->id)
                    ->where('required', 1)->
                    get();
                foreach ($proRequired as $value) {
                    $ifRequired = CartOption::where('cart_id', $cart->id)
                        ->where('option', $value->option)->first();
                    if (!$ifRequired) {
                        if ($required == 0) {
                            $required = 1;
                        }
                    }
                }
            }
        }
        return $required;
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

    public function render()
    {

        $total = $this->totalPrice;

        $options = SiteOption::first();
        return view('livewire.front.order.index', compact( 'options', 'total'))->layout('layouts.front');

    }
}
