<?php

namespace App\Http\Livewire\Front\Order;

use App\Models\Address;
use App\Models\Cart;
use App\Models\CartOption;
use App\Models\Country;
use App\Models\Discount;
use App\Models\Option;
use App\Models\Order;
use App\Models\OrderProdct;
use App\Models\Price_shipping;
use App\Models\productOption;
use App\Models\Shipping;
use App\Models\SiteOption;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Hekmatinasser\Verta\Verta;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Index extends Component
{
    public $user, $totalPrice;
    public $state, $code_posti, $city, $address, $mobile, $lname, $name;
    public $copen, $code = 0, $carts;
    public $addres, $factor, $shipping_method;
    public $description, $payment_method;
    public $post = [];
    public $siteOption;
    public $cartDiscount = 0;
    public $shipping = false;
    public $price_post = 0;

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

    public function price_post($val)
    {
        $this->price_post = $val;
    }

    public function SaveOrder()
    {
        //اعتبار سنجی
        if ($this->shipping) {
            if ($this->totalPrice >= 1) {
                $this->validate([
                    'shipping_method' => 'required',
                    'payment_method' => ['required', Rule::in('sepehr', 'sadad', 'zarinpal', 'offline')],
                ]);
            } else {
                $this->validate([
                    'shipping_method' => 'required',
                ]);
            }
        } else {
            $this->validate([
                'payment_method' => ['required', Rule::in('sepehr', 'sadad', 'zarinpal', 'offline')],
            ]);
        }
        if ($this->shipping) {
            $post_chosen = $this->post[array_search($this->shipping_method, array_column($this->post, '0'))];
            // محاسبه قیمت کل
            $shipping_type = $post_chosen['1'] . ' | زمان تقریبی ' . $post_chosen['3'] . ' روز ';
            $shipping_price = $post_chosen['0'];
            $total = $this->totalPrice - $this->code - $this->cartDiscount + $shipping_price;
        } else {
            $shipping_type = null;
            $shipping_price = null;
            $total = $this->totalPrice - $this->code - $this->cartDiscount;
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
                'copen_code' => $this->copen,
                'copen_price' => $this->code,
                'status' => 1,
                'description' => $this->description,
                'shipping_type' => $shipping_type,
                'shipping_price' => $shipping_price,
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
            $newOrder->shipping_type = $shipping_type;
            $newOrder->shipping_price = $shipping_price;
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
            $optionsave = '';
            $optionId = '';
            foreach ($cart->cartOptions as $option) {
                $productOption = \App\Models\Option::where('value', $option->value)->
                where('option', $option->option)->
                where('product_id', $products->id)->
                first();
                if ($optionId == '') {
                    $optionId = $productOption->id;
                } else {
                    $optionId = $optionId . ',' . $productOption->id;
                }
                if ($optionsave == '') {
                    $optionsave = $productOption->value;

                } else {
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
        if ($this->isDisable()) {
            return redirect(route('Cart'));
        }
        if ($this->isSetAllRequired()) {
            return redirect(route('Cart'));
        }
        $this->validateAllCount();
        $this->siteOption = SiteOption::first();
        $this->totalPrice = 0;
        $this->user = User::with('Addresses')->find(auth()->user()->id);
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        $this->carts = $carts;
        // محاسبه قیمت محصولات سبد خرید
        $weight_cart = 0;
        foreach ($carts as $cart) {
            $newPercent = 0;
            $product = \App\Models\Product::where('id', $cart->product_id)->first();
            $shipping = $product->shipping;
            if ($shipping == 'shipping') {
                $this->shipping = true;
                // محاسبه وزن سبد خرید
                if ($product->weight_class_id == 'kgram') {
                    $weight_product = ($product->weight * 1000);
                    $weight_cart += $weight_product * $cart->count;
                } else {
                    $weight_product = $product->weight;
                    $weight_cart += $weight_product * $cart->count;
                }
                foreach ($cart->cartOptions as $optionWeight) {
                    $productOptionWeight = \App\Models\Option::where('product_id', $product->id)->
                    where('value', $optionWeight->value)->
                    where('option', $optionWeight->option)->
                    first();
                    if (isset($productOptionWeight->weight) && !empty($productOptionWeight->weight)) {

                        if ($productOptionWeight->weight_prefix == 1) {

                            if ($product->weight_class_id == 'kgram') {
                                $weight = ($productOptionWeight->weight * 1000);
                                $weight_cart += $weight * $cart->count;
                            } else {
                                $weight = $productOptionWeight->weight;
                                $weight_cart += $weight * $cart->count;
                            }
                        } else {

                            if ($product->weight_class_id == 'kgram') {
                                $weight = ($productOptionWeight->weight * 1000);
                                if ($weight_cart > 0) {
                                    $weight_cart -= $weight * $cart->count;
                                }

                            } else {
                                $weight = $productOptionWeight->weight;
                                if ($weight_cart > 0) {
                                    $weight_cart -= $weight * $cart->count;
                                }
                            }
                        }
                    }
                }
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
        // محاسبه هزینه پست
        $order = Order::where('user_id', auth()->user()->id)->where('status', 1)->first();
        $price_shipping = Price_shipping::where('min_weight', '<', $weight_cart)->where('max_weight', '>=', $weight_cart)->get()->toArray();
        foreach ($price_shipping as $key => $shipp) {
            $shipping_post = Shipping::where('status', 1)->where('id', $shipp['shipping_id'])->first();
            if (in_array($order->city, $shipping_post->Cities_ShortDistance)) {
                $price_distance = $shipp['price_short_distance'];
                $posttime = $shipping_post->PostTime_ShortDistance;
            } elseif (in_array($order->city, $shipping_post->Cities_CloseDistance)) {
                $price_distance = $shipp['price_close_distance'];
                $posttime = $shipping_post->PostTime_CloseDistance;
            } else {
                $price_distance = $shipp['price_long_distance'];
                $posttime = $shipping_post->PostTime_LongDistance;
            }
            $price = math_eval($shipping_post->formula, [
                'a' => $price_distance,
                'b' => $shipping_post->service_price,
                'c' => $shipping_post->service_percent,
                'd' => $shipping_post->premium_price,
                'e' => $shipping_post->premium_percent,
                'f' => $shipping_post->packing_price,
                'g' => $shipping_post->packing_percent,
                'h' => $shipping_post->tax_percent / 100]);
            $this->post[$key] = [round($price, -1), $shipping_post->title, $shipping_post->img, $posttime, $shipping_post->id];
        }
        // محاسبه تخفیف سبد خرید
        $this->cartDiscount = $this->CartDiscounts($this->totalPrice);
    }

    public function isDisable()
    {
        $disable = 0;
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart) {
            $product = \App\Models\Product::where('status', 1)->where('id', $cart->product_id)->first();
            if ($product) {
                if ($product->type == 'phisical') {
                    if ($product->quantity == 0) {
                        if ($disable == 0) {
                            $disable = 1;
                        }
                    } else {
                        $ids = [];
                        array_push($ids, $product->quantity);
                        foreach ($cart->cartOptions as $option) {
                            $option = Option::where('product_id', $product->id)
                                ->where('option', $option->option)
                                ->where('value', $option->value)
                                ->first();
                            if ($option) {
                                if (isset($option->count) && !empty($option->count)) {
                                    array_push($ids, $option->count);
                                }
                            } else {
                                if ($disable == 0) {
                                    $disable = 1;
                                }

                            }

                        }
                        $min = min($ids);
                        if ($cart->count > $min) {
                            if ($disable == 0) {
                                $disable = 1;
                            }
                        }
                    }
                }
            } else {
                if ($disable == 0) {
                    $disable = 1;
                }
            }
        }
        if ($disable == 1) {
            return true;
        } else {
            return false;
        }
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

    public function validateAllCount()
    {

        $carts = Cart::get();
        foreach ($carts as $cart) {
            $quantity = $cart->product()->pluck('quantity')->first();
            $productId = $cart->product()->pluck('id')->first();
            if (isset($quantity)) {
                $optioncount = $cart->product()->pluck('quantity')->first();
            } else {
                $optioncount = '';
            }
            $options = $cart->cartOptions()->get()->all();
            if (count($options) >= 1) {

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
            if ($type == 'phisical') {
                $max = min((explode(",", $optioncount)));
                $msg = 'تعداد سفارش شما بیش از موجودی انبار است.';
                if ($cart->count > $max) {
                    redirect(route('Cart'))->with('warning', $msg);
                }

            }
            if ($cart->count < $min) {
                $msg = 'تعداد سفارش شما کمتر از حداقل محصول قابل سفارش است.';
                redirect(route('Cart'))->with('warning', $msg);
            }

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

    public function render()
    {

        $total = $this->totalPrice;
        $addresses = Address::where('user_id', auth()->user()->id)->get();
        $countries = Country::all();
        $options = SiteOption::first();
        return view('livewire.front.order.index', compact('addresses', 'options', 'total', 'countries'))->layout('layouts.front');

    }
}
