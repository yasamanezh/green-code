<section class="page-shipping">
    <div class="page-row">
        <div class="col-12 text-center">
            <div class="complate-page-container">
                <div class="success-checkout">

                    <div class="container">
                        @if($paymentType== 'offline')
                            <div class="icon-success">
                                <span class="fa fa-check"></span>
                            </div>
                            <div class="order-success">
                                سفارش
                                <a href="#" class="order-code">{{$bank->order_number}}</a>
                                با موفقیت در سیستم ثبت شد.
                                @isset($bank->address)
                                <span class="order-ready-post">سفارش شما در زمان تعیین شده برای شما ارسال خواهد شد.
                                @endisset
                                        <br>
                                        از اینکه ما را برای خرید انتخاب کردید از شما سپاسگزاریم.
                                        </span>
                            </div>
                            @elseif($paymentType== 'free')
                            <div class="icon-success">
                                <span class="fa fa-check"></span>
                            </div>
                            <div class="order-success">
                                سفارش
                                <a href="#" class="order-code">{{$bank->order_number}}</a>
                                با موفقیت در سیستم ثبت شد.
                                @isset($bank->address)
                                    <span class="order-ready-post">سفارش شما در زمان تعیین شده برای شما ارسال خواهد شد.
                                @endisset     <br>
                                        از اینکه ما را برای خرید انتخاب کردید از شما سپاسگزاریم.
                                        </span>
                            </div>

                        @else
                            @if($receipt==1)
                                <div class="icon-success">
                                    <span class="fa fa-check"></span>
                                </div>
                                <div class="order-success">
                                    سفارش
                                    <a href="#" class="order-code">{{$bank->order_number}}</a>
                                    با موفقیت پرداخت شد.
                                    @isset($bank->address)
                                        <span class="order-ready-post">سفارش شما در زمان تعیین شده برای شما ارسال خواهد شد.
                                     @endisset <br>
                                        از اینکه ما را برای خرید انتخاب کردید از شما سپاسگزاریم.
                                        </span>
                                </div>
                            @else
                                <div class="icon-success warning">
                                    <span class="fa fa-close"></span>
                                </div>
                                <div class="order-success">
                                    سفارش
                                    <a href="#" class="order-code">DKC-57262900</a>
                                    در سیستم ثبت شد اما پرداخت ناموفق بود

                                    <span class="text-warning">برای جلوگیری از لغو سیستمی سفارش،تا 24 ساعت آینده پرداخت را انجام دهید.</span>

                                    <span class="order-ready-post">چنانچه طی این فرایند مبلغی از حساب شما کسر شده است،طی 72 ساعت آینده به حساب شما باز خواهد گشت.</span>
                                </div>

                            @endif
                        @endif
                    </div>
                </div>
                @if($receipt==1)
                <div class="checkout-order-info">
                    <div class="order-info">
                        <div class="order-code">
                            کد سفارش :
                            <span>{{$bank->order_number}}</span>
                        </div>

                        <div class="checkout-process-order-info">

                                @if($receipt==1)
                                سفارش شما با موفقیت در سیستم ثبت شد و هم اکنون
                                <a href="#" class="processing">در حال پردازش</a>
                                است.
                                @elseif($paymentType== 'free')
                                 سفارش شما با موفقت در سیستم ثیت شد.

                                @endif

                            جزئیات این سفارش را می توانید
                            با کلیک بر روی دکمه
                            <a href="{{route('DetailOrder',$bank->order_number)}}" class="link-border">پیگیری سفارش</a>
                            مشاهده نمایید.
                        </div>


                        <div class="parent-btn btn-following-order">
                            <a href="{{route('DetailOrder',$bank->order_number)}}" class="dk-btn dk-btn-info">
                                پیگیری سفارش
                                <i class="fa fa-shopping-bag sign-in"></i>
                            </a>
                        </div>

                    </div>
                </div>
                    @endif
            </div>
        </div>
    </div>
</section>
