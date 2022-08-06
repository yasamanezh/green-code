<div>
    <div class="container-xxl position-relative p-0 mr-3">

        <div class="container-xxl py-5 bread-margin">
            <div class="container my-5 py-5 px-lg-5" style="margin-right: 10%">
                <div class="row g-5 py-5 ">
                    <div class="col-12 text-center">
                        <h1 class="text-white animated zoomIn">حساب کاربری</h1>
                        <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                        <nav aria-label="breadcrumb ">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Home')}}">خانه</a></li>
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Profile')}}">حساب کاربری</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">دانلودها</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl">
        <div class="container px-lg-5">
            <div class="row g-5">
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                    @include('livewire.front.profile.sidbar')
                </div>
                <div class="col-lg-9">
                    <section class="page-contents">
                        <div class="col-xs-12">
                            <div class="profile-stats profile-order">
                                <div class="profile-order-steps-note">
                                    <h4>سفارش {{$order->order_number}}</h4>

                                </div>

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
                                            <tr>
                                                <td colspan="3" class="text-right">لینک دانلود:</td>
                                                <td class="text-right">
                                                    <a href="{{route('Download')}}" class="text-purple-500">لینک دانلود</a>
                                                </td>
                                            </tr>

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
        </div>
    </div>
</div>
