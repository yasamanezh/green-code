<div>
    <div class="container-main">
        <div class="col-12">
            <div class="breadcrumb-container  mt-2">
                <ul class="js-breadcrumb ">
                    <li class="breadcrumb-item">
                        <a href="{{route('Home')}}" class="breadcrumb-link">خانه</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('Profile')}}" class="breadcrumb-link">حساب کاربری من</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('Orders')}}" class="breadcrumb-link">سفارشات</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a class="breadcrumb-link active-breadcrumb">جزئیات سفارش</a>
                    </li>
                </ul>
            </div>
        </div>
        @include('livewire.front.profile.sidbar')
        <div class="col-lg-9 col-md-9 col-xs-12 pull-left">
            <section class="page-contents">
                <div class="col-xs-12">
                    <div class="profile-stats profile-order">
                        <div class="profile-order-steps-note">
                            <h4>سفارش {{$order->order_number}}</h4>
                            @isset($order->address)
                                <span> &nbsp; | &nbsp; </span>

                                <span class="float-right">
                                    @if($order->processing =='wait')
                                        در انتظار پرداخت
                                    @elseif ($order->processing =='complate')
                                        در صف بررسی
                                    @elseif ($order->processing =='progress')
                                        در حال آماده سازی سفارش
                                    @elseif ($order->processing =='sended')
                                        خروج از مرکز پردازش
                                    @elseif ($order->processing =='post')
                                        تحویل به پست
                                    @elseif ($order->processing =='delivered')
                                        تحویل مرسوله به مشتری
                                    @endif
                                    </span>
                            @endisset
                        </div>
                        @isset($order->address)
                            <section class="swiper-container-horizontal">
                                <div class="profile-order-steps-container">
                                    <div class="profile-order-steps-item profile-order-steps-item-active">
                                        <img src="{{asset('assets/images/profile/profile-order-1.svg')}}">
                                        <span>در صف بررسی</span>
                                    </div>
                                    <div class="hr profile-order-steps-item-active"></div>
                                    <div class="profile-order-steps-item @if($order->processing =='progress' || $order->processing =='sended' || $order->processing =='post' || $order->processing =='delivered') ) profile-order-steps-item-active   @endif">
                                        <img src="{{asset('assets/images/profile/profile-order-3.svg')}}">
                                        <span>آماده‌سازی سفارش</span>
                                    </div>
                                    <div class="hr @if($order->processing =='progress' || $order->processing =='sended' || $order->processing =='post' || $order->processing =='delivered') ) profile-order-steps-item-active   @endif"></div>
                                    <div class="profile-order-steps-item @if($order->processing =='sended' || $order->processing =='post' || $order->processing =='delivered') ) profile-order-steps-item-active   @endif">
                                        <img src="{{asset('assets/images/profile/profile-order-4.svg')}}">
                                        <span>خروج از مرکز پردازش</span>
                                    </div>
                                    <div class="hr @if($order->processing =='sended' || $order->processing =='post' || $order->processing =='delivered') ) profile-order-steps-item-active   @endif"></div>
                                    <div class="profile-order-steps-item @if($order->processing =='post' || $order->processing =='delivered') ) profile-order-steps-item-active   @endif">
                                        <img src="{{asset('assets/images/profile/profile-order-5.svg')}}">
                                        <span>تحویل به پست</span>
                                    </div>
                                    <div class="hr @if($order->processing =='post' || $order->processing =='delivered') ) profile-order-steps-item-active   @endif"></div>
                                    <div class="profile-order-steps-item @if(  $order->processing =='delivered') ) profile-order-steps-item-active   @endif">
                                        <img src="{{asset('assets/images/profile/profile-order-7.svg')}}">
                                        <span>تحویل مرسوله به مشتری</span>
                                    </div>
                                </div>
                            </section>

                            <div class=" table-responsive">
                                <table class="table">
                                    <thead class="thead-light" style="text-align: right !important;">
                                    <tr>
                                        <th scope="col">نام تحویل گیرنده</th>
                                        <th scope="col">موبایل</th>
                                        <th scope="col">استان</th>
                                        <th scope="col">محله</th>
                                        <th scope="col">آدرس</th>
                                        <th scope="col">کد پستی</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="order-code">{{$order->name}}</td>
                                        <td class="order-code">{{$order->mobile}}</td>
                                        <td class="order-code">{{\App\Models\Country::where('id',$order->zone)->pluck('name')->first()}}</td>
                                        <td class="order-code">{{\App\Models\City::where('id',$order->zone)->pluck('name')->first()}}</td>
                                        <td class="order-code">{{$order->address}}</td>
                                        <td class="order-code">{{$order->code_posti}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-draught">
                                <div class="table-draught-row">
                                    <div class="table-draught-col">
                                        توضیحات :
                                        @isset($history)
                                            {{$history->description}}
                                        @endisset
                                    </div>
                                    <div class="table-draught-col">زمان
                                        تحویل:
                                        {{explode('|',$order->shipping_type)[1]}}
                                    </div>
                                </div>
                                <div class="table-draught-row">
                                    <div class="table-draught-col">نحوه ارسال سفارش:
                                        {{explode('|',$order->shipping_type)[0]}}
                                    </div>
                                    @if(isset($order->shipping_price) && !empty($order->shipping_price) && $order->shipping_price !=0)
                                    <div class="table-draught-col">هزینه ارسال
                                        : {{number_format($order->shipping_price)}} تومان
                                    </div>
                                    @endif
                                </div>
                                <div class="table-draught-row">
                                    <div class="table-draught-col last-tabel">
                                        مبلغ این مرسوله:
                                        {{number_format($order->prices)}}
                                        تومان
                                    </div>
                                </div>
                            </div>
                        @endisset
                        <div class="table-orders table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">نام محصول</th>
                                    <th scope="col">تعداد</th>
                                    <th scope="col">قیمت واحد</th>
                                    <th scope="col">قیمت کل</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->products as $product)
                                    <tr>
                                        <td>
                                            <h3>{{$product->title}}</h3>
                                        </td>
                                        <td>{{$product->count}}</td>
                                        <td>{{number_format($product->price)}} تومان</td>
                                        <td>{{number_format($product->price*$product->count)}} تومان</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-right">جمع جزء:</td>
                                    <td class="text-right">{{number_format($order->product_price)}} تومان</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">تخفیف بر روی سبد خرید:</td>
                                    <td class="text-right">{{number_format($order->cart_discount_price)}} تومان</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">کوپن تخفیف:</td>
                                    <td class="text-right">{{number_format($order->copen_price)}} تومان</td>
                                </tr>
                                @if(isset($order->address))
                                    @if(isset($order->shipping_price) && !empty($order->shipping_price) && $order->shipping_price!=0)

                                        <tr>
                                        <td colspan="3" class="text-right">هزینه حمل و نقل:</td>
                                        <td class="text-right">{{number_format($order->shipping_price)}} تومان</td>
                                    </tr>
                                        @endif
                                @else
                                    <tr>
                                        <td colspan="3" class="text-right">لینک دانلود:</td>
                                        <td class="text-right">
                                            <a href="{{route('Download')}}" class="text-purple-500">لینک دانلود</a>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="3" class="text-right">جمع:</td>
                                    <td class="text-right">{{number_format($order->prices)}} تومان</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!--    product-slider----------------------------------->
</div>
